<?php if (true || !empty($_COOKIE['sailplay'])):?>
<script charset="utf-8" type="text/javascript">
	var _sp_options = {
		authHash: "<?php echo isset($this->variables['sailPlayAuthHash']) ? $this->variables['sailPlayAuthHash'] : 'none'?>",
		publicKey: "none<?php //echo $this->variables['sailPlayPublicKey']?>",
		partnerId: "1475",
		position: ["center", "right"],
		notifications: {
			enabled: false,
			skin: {type: 'horizontal', position: ['bottom', 'right']}
		}
	};
	(function() {
		var sp = document.createElement("script");
		sp.type = "text/javascript"; sp.async = true; sp.charset = "utf-8";
		sp.src = ("https:" == document.location.protocol ? "https://" : "http://") +
			"sailplay.ru/popup-sdk/js/sailplay/1475/";
		var scr = document.getElementsByTagName("script")[0]; scr.parentNode.insertBefore(sp, scr);
	})();
</script>
<?php endif;?>