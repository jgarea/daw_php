<?php

require(__DIR__ . '/defs.php');
require(__DIR__ . '/../../includes/header.php');
use function Jaxon\pm;
use function Jaxon\rq;
?>

    <div class="container-fluid">
        <div class="row">
<?php require(__DIR__ . '/../../includes/nav.php') ?>
            <div class="col-sm-9 content">
                <h3 class="page-header">Hello World Function</h3>
                <div class="row" id="jaxon-html">
                    <div class="col-md-12" id="div1">
                        &nbsp;
                    </div>
                    <div class="col-md-4 margin-vert-10">
                        <select class="form-control" id="colorselect" name="colorselect"
                                onchange="<?php echo rq()->setColor(pm()->select('colorselect')) ?>">
                            <option value="black" selected="selected">Black</option>
                            <option value="red">Red</option>
                            <option value="green">Green</option>
                            <option value="blue">Blue</option>
                        </select>
                    </div>
                    <div class="col-md-8 margin-vert-10">
                        <button type="button" class="btn btn-primary" onclick="<?php echo rq()->call('helloWorld', 1) ?>" >CLICK ME</button>
                        <button type="button" class="btn btn-primary" onclick="<?php echo rq()->call('helloWorld', 0) ?>" >Click Me</button>
                    </div>
                </div>
            </div> <!-- class="content" -->
       </div> <!-- class="row" -->
    </div>
<div id="jaxon-init">
<script type='text/javascript'>
    /* <![CDATA[ */
    window.onload = function() {
        // call the helloWorld function to populate the div on load
        <?php echo rq()->call('helloWorld', 0) ?>;
        // call the setColor function on load
        <?php echo rq()->setColor(pm()->select('colorselect')) ?>;
    }
    /* ]]> */
</script>
</div>

<?php require(__DIR__ . '/../../includes/footer.php') ?>
