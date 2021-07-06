document.addEventListener('DOMContentLoaded', function(){
    for(var el of document.getElementsByClassName('add-smily')){
        el.addEventListener('click', function(e){
            var myField,
            _self = e.target.dataset.smilies ? e.target : e.target.parentNode,
            tag = ' ' + _self.dataset.smilies + ' ';
            if (document.getElementById('comment') && document.getElementById('comment').type == 'textarea') {
                myField = document.getElementById('comment')
            } else {
                return false
            }
            if (document.selection) {
                myField.focus();
                sel = document.selection.createRange();
                sel.text = tag;
                myField.focus()
            } else if (myField.selectionStart || myField.selectionStart == '0') {
                var startPos = myField.selectionStart;
                var endPos = myField.selectionEnd;
                var cursorPos = endPos;
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