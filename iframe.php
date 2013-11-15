<!DOCTYPE html>
<head>
	<title>Create IFrame</title>
	<link rel="stylesheet" href="<?= admin_url('load-styles.php?c=0&dir=ltr&load=admin-bar,buttons,media-views,wp-admin,wp-auth-check&ver=3.6.1') ?>" />
	<link rel="stylesheet" href="<?= includes_url('css/editor.min.css?ver=3.6.1') ?>" />
	<style>body {min-width:0}</style>
	<script type="text/javascript" src="<?= admin_url('load-scripts.php?c=0&load%5B%5D=jquery-core,jquery-migrate,utils,json2&ver=3.6.1') ?>"></script>
	<script type="text/javascript" src="<?= includes_url('js/tinymce/tiny_mce_popup.js') ?>"></script>
	<script type="text/javascript">
		var FlynIFrame = {
			e: '',
			init: function(e) {
				FlynIFrame.e = e;
				tinyMCEPopup.resizeToInnerSize();
			},
			insert: function createIFrameShortcode(e) {
				var attribs = jQuery('#wp-link :input').serializeArray()

				var output = '[iframe ';
				for ( i=0; i<attribs.length; i++ )
					output += attribs[i].name + '="' + attribs[i].value.replace('"', "'") + '" ';

				output += ']';

				tinyMCEPopup.execCommand('mceReplaceContent', false, output);

				tinyMCEPopup.close();
			}
		}
		tinyMCEPopup.onInit.add(FlynIFrame.init, FlynIFrame);
	</script>
</head>
<body class="wp-core-ui">
	<form id="wp-link">
		<div id="link-options">
			<div>
				<label><span>URL</span><input id="url" name="src" type="text"></label>
			</div>
			<div>
				<label><span>Width</span><input id="width" type="text" name="width"></label><br/>
				<label><span>&nbsp;</span><em>e.g. 400px or 100%</em></label>
			</div>
			<div>
				<label><span>Height</span><input id="height" type="text" name="height"></label><br/>
				<label><span>&nbsp;</span><em>e.g. 600px or 75%</em></label>
			</div>
			<div>
				<label><input type="checkbox" id="frameborder" name="frameborder" value="1"> Show the iframe border?</label>
			</div>
			<div>
				<label><span>Scrollbars</span>
				<select id="scrolling" name="scrolling">
					<option value="auto">Auto</option>
					<option value="yes">Yes</option>
					<option value="yes">No</option>
				</select>
				<br/>
			</div>
		</div>

		<div class="submitbox">
			<div id="wp-link-update">
				<input type="button" value="Add IFrame" class="button-primary" onclick="javascript:FlynIFrame.insert(FlynIFrame.e)">
			</div>
			<div id="wp-link-cancel">
				<a class="submitdelete deletion" href="#" onclick="tinyMCEPopup.close();">Cancel</a>
			</div>
		</div>
</form>
</body>
</html>