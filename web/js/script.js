const coll = document.getElementsByClassName("collapsible");
let i;

for (i = 0; i < coll.length; i++) {
    coll[i].addEventListener("click", function () {
        this.classList.toggle("active");
        let content = this.nextElementSibling;
        if (content.style.maxHeight) {
            content.style.maxHeight = null;
        } else {
            content.style.maxHeight = content.scrollHeight + "px";
        }
    });
}


var resizeButton = document.querySelector('.resize-button');
resizeButton.addEventListener('click', function () {
    var desiredWidth = 800;
    var desiredHeight = 600;
    window.resizeTo(desiredWidth, desiredHeight);
});

