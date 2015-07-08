<?php

App::uses('FormHelper', 'View/Helper');

class TinyMceHelper extends AppHelper
{

    public $helpers = array('Form', 'Html');
    private $_MceAdded = false;

    public function tinyMce($model = null, $options = array())
    {
        $this->Html->script('tiny_mce/tiny_mce', array('inline' => false));
        $textareaId = $this->Html->domId($model) . $this->getID();
        $options = Set::merge(array('type' => 'textarea', 'id' => $textareaId, 'class' => ''), $options);

        $options['class'] .= ' tinymcetransform mce-' . $textareaId;

        if (!$this->_MceAdded) // Unused ATM
        {
            /*
              if (isset($options['templateeditor']))
              $this->Html->scriptBlock('
              $(function() {
              tinymce.create("tinymce.plugins.PlaceholderPlugin", {
              createControl: function(n, cm) {
              switch (n) {
              case "placeholderbutton":
              var c = cm.createMenuButton("placeholderbutton", {
              title : "' . __('Insert Placeholder') . '",
              image : "' . Router::url('/', true) . 'img/icons/lightning.png",
              icons : false
              });
              c.onRenderMenu.add(function(c, m) {
              m.add({title : "' . __('Username') . '", onclick : function() {
              tinyMCE.activeEditor.execCommand("mceInsertContent", false, "{UserName}");
              }});
              m.add({title : "' . __('User Email') . '", onclick : function() {
              tinyMCE.activeEditor.execCommand("mceInsertContent", false, "{UserEmail}");
              }});
              m.add({title : "' . __('Project Name') . '", onclick : function() {
              tinyMCE.activeEditor.execCommand("mceInsertContent", false, "{ProjectName}");
              }});
              m.add({title : "' . __('Project Url') . '", onclick : function() {
              tinyMCE.activeEditor.execCommand("mceInsertContent", false, "{ProjectUrl}");
              }});
              m.add({title : "' . __('Start IsNewUser') . '", onclick : function() {
              tinyMCE.activeEditor.execCommand("mceInsertContent", false, "{StartIsNewUser}");
              }});
              m.add({title : "' . __('End IsNewUser') . '", onclick : function() {
              tinyMCE.activeEditor.execCommand("mceInsertContent", false, "{EndIsNewUser}");
              }});
              m.add({title : "' . __('Temporary Password') . '", onclick : function() {
              tinyMCE.activeEditor.execCommand("mceInsertContent", false, "{TempPassword}");
              }});
              m.add({title : "' . __('System Name') . '", onclick : function() {
              tinyMCE.activeEditor.execCommand("mceInsertContent", false, "{SystemName}");
              }});
              });
              return c;
              }
              return null;
              }
              });

              tinymce.PluginManager.add("placeholder", tinymce.plugins.PlaceholderPlugin);
              });
              ', array('inline' => false));

              $this->Html->scriptBlock('
              $(function() {
              $("textarea").each(function(){
              if($(this).hasClass("tinymcetransform"))
              {
              tinyMCE.init({
              mode : "specific_textareas",
              theme_advanced_path : false,
              editor_selector : $(this).attr("id"),
              content_css : "' . Router::url('/', true) . 'css/editor_content.css",
              theme_advanced_buttons1 : "' . (isset($options['templateeditor']) ? 'placeholderbutton,' : '') . 'bold,italic,underline,strikethrough,separator,numlist,bullist",
              ' . ((isset($options['templateeditor'])) ? 'plugins : "noneditable,placeholder", noneditable_regexp: /\{[^}]+\}/g' : '') . '
              });
              tinyMCE.execCommand("mceAddControl", false, $(this).attr("id"));
              }
              });
              });
              ', array('inline' => false));
             */
            $this->Html->scriptBlock('

           $(function() {

                tinyMCE.init({
                        cleanup: true,
                        mode : "specific_textareas",
                        theme_advanced_path : false,
                        plugins: "autoresize,paste",
                        paste_text_sticky : true,
                        setup : function(ed) {
                            ed.onInit.add(function(ed) {
                                     ed.pasteAsPlainText = true;
                            });
                        },
                        width: "100%",
                        editor_selector : "tinymcetransform",
                        content_css : "' . Router::url('/', true) . 'css/editor_content.css",
                        theme_advanced_buttons1 : "' . (isset($options['templateeditor']) ? 'placeholderbutton,' : '') . 'bold,italic,underline,strikethrough,separator,forecolor,backcolor,separator,numlist,bullist",
                        theme_advanced_buttons2 : "undo,redo,separator,link,unlink,separator,code",
                        ' . ((isset($options['templateeditor'])) ? 'plugins : "noneditable,placeholder", noneditable_regexp: /\{[^}]+\}/g' : '') . '
                });   
                tinyMCE.execCommand("mceAddControl", false, "tinymcetransform");

            });
            ', array('inline' => false));

            $this->_MceAdded = true;
        }

        return $this->Form->input($model, $options);
    }

}