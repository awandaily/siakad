
<?php
    //use voku\htmlmin\src\helper\HtmlMin;

    $id = $_POST["id"];

    if ($id!="") {
        $this->db->where("id", $id);
        $d = $this->db->get("tm_persuratan")->row_array();

        $nama_surat     = $d["nama_surat"];
        $template       = $d["template"];
        $form           = $d["form"];
        $exec           = $d["exec"];     

    }
    else{
        $nama_surat     = "";
        $template       = "";
        $form           = "";
        $exec           = "";
    }

?>

<div class="form-group">
    <label>Nama Surat</label><br>
    <input type="text" class="form-control" name="f[nama_surat]" autofocus="" required="" value="<?php echo $nama_surat ?>">
</div>

<div class="form-group">
    <label>Template Surat</label><br>
    <textarea  class="form-control" name="template" id="ck-template" required></textarea>
</div>

<div class="form-group">
    <label>Form Input</label><br>
    <textarea  class="form-control" name="f[form]" id="ck-form" style="height: 200px;" ><?php echo $form ?></textarea>
</div>
<div class="form-group">
    <label>Action PHP</label><br>
    <textarea  class="form-control" name="f[exec]" style="height: 200px;"><?php echo $exec ?></textarea>
</div>
<?php
    
?>
<script type="text/javascript">


    CKEDITOR.replace( 'ck-template', {
        // Define the toolbar: https://ckeditor.com/docs/ckeditor4/latest/features/toolbar.html
        // The full preset from CDN which we used as a base provides more features than we need.
        // Also by default it comes with a 3-line toolbar. Here we put all buttons in a single row.


        // Since we define all configuration options here, let's instruct CKEditor to not load config.js which it does by default.
        // One HTTP request less will result in a faster startup time.
        // For more information check https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_config.html#cfg-customConfig
        customConfig: '',

        // Sometimes applications that convert HTML to PDF prefer setting image width through attributes instead of CSS styles.
        // For more information check:
        //  - About Advanced Content Filter: https://ckeditor.com/docs/ckeditor4/latest/guide/dev_advanced_content_filter.html
        //  - About Disallowed Content: https://ckeditor.com/docs/ckeditor4/latest/guide/dev_disallowed_content.html
        //  - About Allowed Content: https://ckeditor.com/docs/ckeditor4/latest/guide/dev_allowed_content_rules.html
        disallowedContent: 'img{width,height,float}',
        extraAllowedContent: 'img[width,height,align]',

        // Enabling extra plugins, available in the full-all preset: https://ckeditor.com/cke4/presets-all
        extraPlugins: 'tableresize, uploadimage, ckeditor_wiris',
        removePlugins: 'htmlwriter',

        /*********************** File management support ***********************/
        // In order to turn on support for file uploads, CKEditor has to be configured to use some server side
        // solution with file upload/management capabilities, like for example CKFinder.
        // For more information see https://ckeditor.com/docs/ckeditor4/latest/guide/dev_ckfinder_integration.html

        // Uncomment and correct these lines after you setup your local CKFinder instance.
        // filebrowserBrowseUrl: 'http://example.com/ckfinder/ckfinder.html',
        // filebrowserUploadUrl: 'http://example.com/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        /*********************** File management support ***********************/

        // Make the editing area bigger than default.
        height: 800,

        // An array of stylesheets to style the WYSIWYG area.
        // Note: it is recommended to keep your own styles in a separate file in order to make future updates painless.
        contentsCss: [ 'https://cdn.ckeditor.com/4.8.0/full-all/contents.css', '<?php echo base_url()?>plug/ckeditor/mystyles.css' ],

        // This is optional, but will let us define multiple different styles for multiple editors using the same CSS file.
        bodyClass: 'document-editor',

        // Reduce the list of block elements listed in the Format dropdown to the most commonly used.
        format_tags: 'p;h1;h2;h3;pre',

        // Simplify the Image and Link dialog windows. The "Advanced" tab is not needed in most cases.
        removeDialogTabs: 'image:advanced;link:advanced',

        // Define the list of styles which should be available in the Styles dropdown list.
        // If the "class" attribute is used to style an element, make sure to define the style for the class in "mystyles.css"
        // (and on your website so that it rendered in the same way).
        // Note: by default CKEditor looks for styles.js file. Defining stylesSet inline (as below) stops CKEditor from loading
        // that file, which means one HTTP request less (and a faster startup).
        // For more information see https://ckeditor.com/docs/ckeditor4/latest/features/styles.html
        stylesSet: [
            /* Inline Styles */
            { name: 'Marker', element: 'span', attributes: { 'class': 'marker' } },
            { name: 'Cited Work', element: 'cite' },
            { name: 'Inline Quotation', element: 'q' },

            /* Object Styles */
            {
                name: 'Special Container',
                element: 'div',
                styles: {
                    padding: '5px 10px',
                    background: '#eee',
                    border: '1px solid #ccc'
                }
            },
            {
                name: 'Compact table',
                element: 'table',
                attributes: {
                    cellpadding: '5',
                    cellspacing: '0',
                    border: '1',
                    bordercolor: '#ccc'
                },
                styles: {
                    'border-collapse': 'collapse'
                }
            },
            { name: 'Borderless Table', element: 'table', styles: { 'border-style': 'hidden', 'background-color': '#E6E6FA' } },
            { name: 'Square Bulleted List', element: 'ul', styles: { 'list-style-type': 'square' } }
        ]
    } );

    //CKEDITOR.config.contentsCss("<?php echo base_url() ?>plug/ckeditor/mystyles.css");

    //CKEDITOR.replace('ck-form');

    //var tmp = '<?php echo $template ?>';
    //var tmp1 = tmp.replace(/\n|\t/g, ' ');

    CKEDITOR.instances['ck-template'].setData('<?php echo $template ?>');
    //CKEDITOR.instances['ck-form'].setData('');

    CKEDITOR.config.height = 500;
    //CKEDITOR.config.extraPlugins = "lineheight";
</script>

