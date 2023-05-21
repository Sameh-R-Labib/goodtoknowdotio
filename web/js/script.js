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


window.addEventListener('load', function () {
    // Set the desired width and height for the window
    let desiredWidth = 800;
    let desiredHeight = 600;

    // Resize the window using the resizeTo() method
    window.resizeTo(desiredWidth, desiredHeight);
});

