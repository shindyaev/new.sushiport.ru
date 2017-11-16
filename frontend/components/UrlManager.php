<?php

class UrlManager extends CUrlManager
{
	
	public $seo;
	
	private $_urlFormat=self::GET_FORMAT;
	private $_rules=array();
	private $_baseUrl;
	
	/**
	 * Processes the URL rules.
	 */
	protected function processRules()
	{
		if(empty($this->rules) || $this->getUrlFormat()===self::GET_FORMAT)
			return;
		if($this->cacheID!==false && ($cache=Yii::app()->getComponent($this->cacheID))!==null)
		{
			$hash=md5(serialize($this->rules));
			if(($data=$cache->get(self::CACHE_KEY))!==false && isset($data[1]) && $data[1]===$hash)
			{
				$this->_rules=$data[0];
				return;
			}
		}
		foreach($this->rules as $pattern=>$route)
			$this->_rules[]=$this->createUrlRule($route,$pattern);
		if(isset($cache))
			$cache->set(self::CACHE_KEY,array($this->_rules,$hash));
	}
	
	/**
	 * Creates a URL rule instance.
	 * The default implementation returns a CUrlRule object.
	 * @param mixed $route the route part of the rule. This could be a string or an array
	 * @param string $pattern the pattern part of the rule
	 * @return CUrlRule the URL rule instance
	 * @since 1.1.0
	 */
	protected function createUrlRule($route,$pattern)
	{
		if(is_array($route) && isset($route['class']))
			return $route;
		else
		{
			$urlRuleClass=Yii::import($this->urlRuleClass,true);
			return new $urlRuleClass($route,$pattern);
		}
	}
	
	/**
	 * Creates a URL based on default settings.
	 * @param string $route the controller and the action (e.g. article/read)
	 * @param array $params list of GET parameters
	 * @param string $ampersand the token separating name-value pairs in the URL.
	 * @return string the constructed URL
	 */
	protected function createUrlDefault($route,$params,$ampersand)
	{
		if($this->getUrlFormat()===self::PATH_FORMAT)
		{
			$url=rtrim($this->getBaseUrl().'/'.$route,'/');
			if($this->appendParams)
			{
				$url=rtrim($url.'/'.$this->createPathInfo($params,'/','/'),'/');
				return $route==='' ? $url : $url.$this->urlSuffix;
			}
			else
			{
				if($route!=='')
					$url.=$this->urlSuffix;
				$query=$this->createPathInfo($params,'=',$ampersand);
				return $query==='' ? $url : $url.'?'.$query;
			}
		}
		else
		{
			$url=$this->getBaseUrl();
			if(!$this->showScriptName)
				$url.='/';
			if($route!=='')
			{
				$url.='?'.$this->routeVar.'='.$route;
				if(($query=$this->createPathInfo($params,'=',$ampersand))!=='')
					$url.=$ampersand.$query;
			}
			elseif(($query=$this->createPathInfo($params,'=',$ampersand))!=='')
			$url.='?'.$query;
			return $url;
		}
	}
	
	
	public function parseUrl($request)
	{
		if($this->getUrlFormat()===self::PATH_FORMAT)
		{
			$seoUrlNew=Yii::app()->cache->get("seoUrlNew");
			$seoUrlOld=Yii::app()->cache->get("seoUrlOld");
			if (empty($seoUrlNew)) {
				$seoRules = Seo::model()->findAll();
				$seoUrlNew = array();
				$seoUrlOld = array();
				foreach($seoRules AS $key => $val) {
					if (!empty($val->urlNew))
						$seoUrlNew[$val->urlNew] = $val;
					$seoUrlOld[$val->urlOld] = $val;
				}
				Yii::app()->cache->set("seoUrlNew",$seoUrlNew, 300);
				Yii::app()->cache->set("seoUrlOld",$seoUrlOld, 300);
			}
				
			$rawPathInfo=$seoPath=$request->getPathInfo();
			
			$seoPath = '/'.$seoPath;

			if ($seoPath[strlen($seoPath) - 1] != '/')
				$seoPath = $seoPath.'/';

			$seo = false;
			if (!empty($seoUrlNew[$seoPath])) {
				$seo = $seoUrlNew[$seoPath];
				$rawPathInfo = $seoUrlNew[$seoPath]->urlOld;
			} elseif (!empty($seoUrlOld[$seoPath])) {
				$seo = $seoUrlOld[$seoPath];
				if (!empty($seoUrlOld[$seoPath]->urlNew)) {
					Yii::app()->request->redirect($seoUrlOld[$seoPath]->urlNew);
				}
			}

			if (!empty($rawPathInfo) && $rawPathInfo[0] == '/') 
				$rawPathInfo = substr($rawPathInfo, 1);
			
			if (!empty($rawPathInfo) && $rawPathInfo[strlen($rawPathInfo) - 1] == '/')
				$rawPathInfo = substr($rawPathInfo, 0, -1);
			
			$this->seo = $seo;

			$pathInfo=$this->removeUrlSuffix($rawPathInfo,$this->urlSuffix);
			foreach($this->_rules as $i=>$rule)
			{
				if(is_array($rule))
					$this->_rules[$i]=$rule=Yii::createComponent($rule);
				if(($r=$rule->parseUrl($this,$request,$pathInfo,$rawPathInfo))!==false)
					return isset($_GET[$this->routeVar]) ? $_GET[$this->routeVar] : $r;
			}
			if($this->useStrictParsing)
				throw new CHttpException(404,Yii::t('yii','Unable to resolve the request "{route}".',
						array('{route}'=>$pathInfo)));
			else
				return $pathInfo;
		}
		elseif(isset($_GET[$this->routeVar]))
		return $_GET[$this->routeVar];
		elseif(isset($_POST[$this->routeVar]))
		return $_POST[$this->routeVar];
		else
			return '';
	}
	
	public function createCPUUrl($url) {
		$seoUrlOld = Yii::app()->cache->get("seoUrlOld");
		if (!empty($seoUrlOld[$url]) && !empty($seoUrlOld[$url]->urlNew)) {
			return $seoUrlOld[$url]->urlNew;
		} else {
			return $url;
		}
	}
	
}
