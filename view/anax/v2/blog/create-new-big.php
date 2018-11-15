<form method="post">
    <fieldset>
    <legend>Edit</legend>
    <input type="hidden" name="contentId" value="<?= htmlentities($id) ?>"/>
    <br>Title:
    <input type="text" name="contentTitle" value="<?= htmlentities($title) ?>"/>
    <br>Path:
    <input type="text" name="contentPath" value=""/>
    <br>Slug:
    <input type="text" name="contentSlug" value=""/>
    <br>Text:
    <textarea name="contentData"></textarea>
    <br>Type:
    <input type="text" name="contentType" value=""/>
    <br>Filter:
    <input type="text" name="contentFilter" value=""/>
    <br>Publish:
    <input type="datetime" name="contentPublish" value="<?= date("Y-m-d h:i:s"); ?>"/>
    <br>
    <button type="submit" name="doSave" value="doSave"><i class="fa fa-floppy-o" aria-hidden="true"></i>Save</button>
    <button type="reset"><i class="fa fa-undo" aria-hidden="true"></i> Reset</button>
    <button type="submit" name="doDelete" value="doDelete"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
    </fieldset>
</form>
