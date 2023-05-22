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


var openWindowButton = document.querySelector('.open-window-button');
openWindowButton.addEventListener('click', function () {
    var desiredWidth = 1500;
    var desiredHeight = 1700;
    var windowFeatures = 'width=' + desiredWidth + ',height=' + desiredHeight;
    window.open('https://goodtoknow.io/ax1', '_blank', windowFeatures);
});

