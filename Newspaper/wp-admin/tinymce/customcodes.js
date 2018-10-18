// JavaScript Document



(function() {
    // Creates a new plugin class and a custom listbox
    tinymce.create('tinymce.plugins.td_article_block', {
        createControl: function(n, cm) {
            switch (n) {
                case 'td_article_block':
                    var mlb = cm.createListBox('td_article_block', {
                        title : 'tagDiv shortcodes',
                        onselect : function(v) {
                            
                            
                            switch(v) {
                                case '[quote_center]':
                                    tinymce.activeEditor.execCommand('mceInsertContent', false, '[quote_center][/quote_center]');
                                    break;

                                case '[quote_right]':
                                    tinymce.activeEditor.execCommand('mceInsertContent', false, '[quote_right][/quote_right]');
                                    break;
                                
                                case '[quote_left]':
                                    tinymce.activeEditor.execCommand('mceInsertContent', false, '[quote_left][/quote_left]');
                                    break;

                                case '[quote_box_center]':
                                    tinymce.activeEditor.execCommand('mceInsertContent', false, '[quote_box_center][/quote_box_center]');
                                    break;

                                case '[quote_box_left]':
                                    tinymce.activeEditor.execCommand('mceInsertContent', false, '[quote_box_left][/quote_box_left]');
                                    break;

                                case '[quote_box_right]':
                                    tinymce.activeEditor.execCommand('mceInsertContent', false, '[quote_box_right][/quote_box_right]');
                                    break;

                                case '[pull_quote_center]':
                                    tinymce.activeEditor.execCommand('mceInsertContent', false, '[pull_quote_center][/pull_quote_center]');
                                    break;

                                case '[pull_quote_left]':
                                    tinymce.activeEditor.execCommand('mceInsertContent', false, '[pull_quote_left][/pull_quote_left]');
                                    break;

                                case '[pull_quote_right]':
                                    tinymce.activeEditor.execCommand('mceInsertContent', false, '[pull_quote_right][/pull_quote_right]');
                                    break;

                                case '[dropcap box]':
                                    tinymce.activeEditor.execCommand('mceInsertContent', false, '[dropcap][/dropcap]');
                                    break;

                                case '[dropcap circle]':
                                    tinymce.activeEditor.execCommand('mceInsertContent', false, '[dropcap type="1"][/dropcap]');
                                    break;

                                case '[dropcap regular]':
                                    tinymce.activeEditor.execCommand('mceInsertContent', false, '[dropcap type="2"][/dropcap]');
                                    break;

                                case '[dropcap bold]':
                                    tinymce.activeEditor.execCommand('mceInsertContent', false, '[dropcap type="3"][/dropcap]');
                                    break;

                                case '[1/1]':
                                    tinymce.activeEditor.execCommand('mceInsertContent', false, '[vc_row][vc_column width="1/1"]Add content here[/vc_column][/vc_row]');
                                    break;

                                case '[1/2]':
                                    tinymce.activeEditor.execCommand('mceInsertContent', false, '[vc_row][vc_column width="1/2"]Add content here[/vc_column][vc_column width="1/2"]Add content here[/vc_column][/vc_row]');
                                    break;

                                case '[1/3]':
                                    tinymce.activeEditor.execCommand('mceInsertContent', false, '[vc_row][vc_column width="1/3"]Add content here[/vc_column][vc_column width="1/3"]Add content here[/vc_column][vc_column width="1/3"]Add content here[/vc_column][/vc_row]');
                                    break;

                                case '[2/3 - 1/3]':
                                    tinymce.activeEditor.execCommand('mceInsertContent', false, '[vc_row][vc_column width="2/3"]Add content here[/vc_column][vc_column width="1/3"]Add content here[/vc_column][/vc_row]');
                                    break;

                                case '[1/3 - 2/3]':
                                    tinymce.activeEditor.execCommand('mceInsertContent', false, '[vc_row][vc_column width="1/3"]Add content here[/vc_column][vc_column width="2/3"]Add content here[/vc_column][/vc_row]');
                                    break;

                                case '[1/4]':
                                    tinymce.activeEditor.execCommand('mceInsertContent', false, '[vc_row][vc_column width="1/4"]Add content here[/vc_column][vc_column width="1/4"]Add content here[/vc_column][vc_column width="1/4"]Add content here[/vc_column][vc_column width="1/4"]Add content here[/vc_column][/vc_row]');
                                    break;

                                case '[vc_button_small]':
                                    tinymce.activeEditor.execCommand('mceInsertContent', false, '[vc_button title="Button" target="_self" color="default" size="size_small" href="#"]');
                                    break;

                                case '[vc_button_medium]':
                                    tinymce.activeEditor.execCommand('mceInsertContent', false, '[vc_button title="Button" target="_self" color="default" href="#"]');
                                    break;

                                case '[vc_button_large]':
                                    tinymce.activeEditor.execCommand('mceInsertContent', false, '[vc_button title="Button" target="_self" color="default" size="size_large" href="#"]');
                                    break;

                                case '[vc_button_small2]':
                                    tinymce.activeEditor.execCommand('mceInsertContent', false, '[vc_button title="Button" target="_self" color="default" size="size_small2" href="#"]');
                                    break;

                                case '[vc_button_medium2]':
                                    tinymce.activeEditor.execCommand('mceInsertContent', false, '[vc_button title="Button" target="_self" color="default" size="default2" href="#"]');
                                    break;

                                case '[vc_button_large2]':
                                    tinymce.activeEditor.execCommand('mceInsertContent', false, '[vc_button title="Button" target="_self" color="default" size="size_large2" href="#"]');
                                    break;

  
  
                            }
                        }
                        
                        
                    });
                    
                    
                    // Add some values to the list box
                    mlb.add('-------- Quotes --------', '');
                    mlb.add('Center', '[quote_center]');
                    mlb.add('Left', '[quote_left]');
                    mlb.add('Right', '[quote_right]');
                    mlb.add('Box quote center', '[quote_box_center]');
                    mlb.add('Box quote left', '[quote_box_left]');
                    mlb.add('Box quote right', '[quote_box_right]');
                    mlb.add('Pull quote center', '[pull_quote_center]');
                    mlb.add('Pull quote left', '[pull_quote_left]');
                    mlb.add('Pull quote right', '[pull_quote_right]');
                    mlb.add('-------- Dropcaps --------', '');
                    mlb.add('Box', '[dropcap box]');
                    mlb.add('Circle', '[dropcap circle]');
                    mlb.add('Regular', '[dropcap regular]');
                    mlb.add('Bold', '[dropcap bold]');
                    mlb.add('-------- Columns --------', '');
                    mlb.add('1/1 Column', '[1/1]');
                    mlb.add('1/2 Columns', '[1/2]');
                    mlb.add('1/3 Columns', '[1/3]');
                    mlb.add('2/3 - 1/3 Columns', '[2/3 - 1/3]');
                    mlb.add('1/3 - 2/3 Columns', '[1/3 - 2/3]');
                    mlb.add('1/4 Columns', '[1/4]');
                    mlb.add('-------- Buttons --------', '');
                    mlb.add('Small', '[vc_button_small]');
                    mlb.add('Medium', '[vc_button_medium]');
                    mlb.add('Large', '[vc_button_large]');
                    mlb.add('Small 2', '[vc_button_small2]');
                    mlb.add('Medium 2', '[vc_button_medium2]');
                    mlb.add('Large 2', '[vc_button_large2]');

                   
                    

                    
                    // Return the new listbox instance
                    return mlb;
            }
            return null;
        }
    });
    tinymce.PluginManager.add('td_article_block', tinymce.plugins.td_article_block);
})();