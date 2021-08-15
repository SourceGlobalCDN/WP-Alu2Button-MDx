document.addEventListener('DOMContentLoaded', function(){
    for (let el of document.getElementsByClassName('add-smily')) {
        el.addEventListener('click', function (e) {
            let myField,
                _self = e.target.dataset.smilies ? e.target : e.target.parentNode,
                tag = ' ' + _self.dataset.smilies + ' ';
            if (document.getElementById('comment') && document.getElementById('comment').type === 'textarea') {
                myField = document.getElementById('comment')
            } else {
                return false
            }
            if (document.selection) {
                myField.focus();
                let sel = document.selection.createRange();
                sel.text = tag;
                myField.focus()
            } else if (myField.selectionStart || myField.selectionStart === '0') {
                let startPos = myField.selectionStart;
                let endPos = myField.selectionEnd;
                let cursorPos = endPos;
                myField.value = myField.value.substring(0, startPos) + tag + myField.value.substring(endPos, myField.value.length);
                cursorPos += tag.length;
                myField.focus();
                myField.selectionStart = cursorPos;
                myField.selectionEnd = cursorPos
            } else {
                myField.value += tag;
                myField.focus()
            }
        });
    }
});