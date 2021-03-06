<div id="help-template" class="outer">
    <h1 class="head">Help:
        <a class="ui-corner-all tooltip" href="<{$xoops_url}>/modules/<{$smarty.const._MI_WFL_DIRNAME}>/admin/index.php"
           title="Back to the administration of <{$smarty.const._MI_WFL_NAME}>"> <{$smarty.const._MI_WFL_NAME}>
            <img src="<{xoAdminIcons home.png}>"
                 alt="Back to the Administration of <{$smarty.const._MI_WFL_NAME}>">
        </a></h1>

    <h4 class="odd">Convert</h4><br>

    <span style="background-color: #ffff99;">Instructions for converting from myLinks to WF-Links.</span><br><span
        style="background-color: #ffff99;">If you want to do a fresh install of WF-Links please select 'Install'.</span><br><br><b><span
        style="color: #ff0000;">Remember: It is always a good idea to make a database backup before installing any modules.</span></b><br>
    <h4>Conversion from Xoops myLinks/webLinks ==> WF-Links</h4>

    <p><br>Note: When you do the conversion the update script will convert the myLinks/webLinks tables in the database
        into WF-Links tables. After the conversion you can't use myLinks/webLinks
        anymore because it is missing tables then. If you want to keep your myLinks/webLinks working you would have to
        backup the myLinks/webLinks tables before you start updating and restore them
        afterwards. It is possible to have WF-Links and myLinks/webLinks running at the same time (though we don't know
        why you would won't that). <br><br><b>1) Make a backup</b></p>

    <p><span style="color: #000000; ">&nbsp; &nbsp; Backup the myLinks/webLinks tables from your database<br><br></span><b>2)
        Upload the module to your website</b></p>

    <p>&nbsp; &nbsp; &nbsp;Upload the 'modules' and 'uploads' folder to your {xoops-rootdirectory}<br><br></p>

    <p><b>3) Change and verify folder permissions</b><br><br>CHMOD the following folders to 777:</p>

    <p>
        <br><em>{xoops-rootdirectory}/uploads/images</em><br><em>{xoops-rootdirectory}/uploads/images/category</em><br><em>{xoops-rootdirectory}/uploads/images/category/thumbs</em><br><em>{xoops-rootdirectory}/uploads/images/flags</em><br><em>{xoops-rootdirectory}/uploads/images/flags/flags_small</em><br><em>{xoops-rootdirectory}/uploads/images/screenshots</em><br><em>{xoops-rootdirectory}/uploads/images/screenshots/thumbs</em><br><em>{xoops-rootdirectory}/uploads/images/thumbs</em><br><br><b>4)
        Install the module</b></p>

    <p>&nbsp; &nbsp; &nbsp;Login as administrator and enter Xoops Administration page. Select System --> modules and
        install WF-Links<br><br><b>5) Start the conversion script</b></p>
    <ul>
        <li>Point your browser to {xoops-rootdirectory}/modules/wflinks/update.php and execute the update script.</li>
        <li>Follow the instructions provided during the install procedure.</li>
        <li>The script will try to determine which version or versions of myLinks or webLinks you have installed and
            will try to update it.
        </li>
    </ul>
    <br>
    <p><b>6) Update the module</b></p>

    <p>&nbsp; &nbsp;Return to System --> Modules and update WF-Links, otherwise the templates will be for the
        previous version and the pages will display correctly.<br><br></p>

    <p><b>7) Configure the module</b></p>

    <p>&nbsp; &nbsp; Most importent steps now will be to setup the group permissions for the module and its blocks via
        System --> Groups<br><br><b>8) Restore or remove myLinks/webLinks</b></p>

    <p>If you want to continue using myLinks or webLinks in addition to WF-Links then restore your myLinks/webLinks
        tables<br>now from the backup you did in step 1. If you don't want to use those
        anymore deactivate the old module and uninstall it.<br><br></p>
</div>
