(function() {
    function getSmileySrc(smiley) {
        if (/\.([^.]+)$/.test(smiley)) {
            return _smileySettings.src_url + smiley;
        } else {
            return ''.concat(twemoji.base, '72x72'/*twemoji.size*/, '/', twemoji.convert.toCodePoint(smiley), twemoji.ext);
        }
    }
    function getHtml() {
        let smilies = _smileySettings.smilies;
        let idx = 1;
        let cols = 5;
        let emoticonsHtml;
        emoticonsHtml = '<table role="list" class="mce-grid">';
        for (let smily in smilies) {
            let emoticonUrl = getSmileySrc(smilies[smily]);

            if (idx % cols === 1) emoticonsHtml += '<tr>';
            emoticonsHtml += '<td><a href="#" data-mce-url="' + emoticonUrl + '" data-mce-alt="' + smily + '" tabindex="-1" ' +
                'role="option" aria-label="' + smily + '"><img src="' +
                emoticonUrl + '" style="width: 24px; height: 24px" role="presentation" /></a></td>';

            if (idx % cols === 5) emoticonsHtml += '</tr>';
            idx++;
        }
        emoticonsHtml += '</table>';
        return emoticonsHtml;
    }
    tinymce.PluginManager.add('smiley', function(editor, url) {
        editor.addButton('smiley', {
            type: 'panelbutton',
            panel: {
                classes: 'smily',
                role: 'application',
                autohide: true,
                html: getHtml,
                onclick: function(e) {
                    let linkElm = editor.dom.getParent(e.target, 'a');
                    if (linkElm) {
                        editor.insertContent(
                            '&nbsp;' + linkElm.getAttribute('data-mce-alt') + '&nbsp;'
                        );
                        this.hide();
                    }
                }
            },
            tooltip: 'Emoticons'
        });
    });
})();