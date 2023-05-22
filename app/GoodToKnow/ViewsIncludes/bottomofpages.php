<script src="/js/script.js"></script>
<script>
    let openWindowButton = document.querySelector('.open-window-button');
    openWindowButton.addEventListener('click', function () {
        let desiredWidth = 1024;
        let desiredHeight = 1700;
        let windowFeatures = 'width=' + desiredWidth + ',height=' + desiredHeight;
        window.open('<?= SERVER_URL ?>', '_blank', windowFeatures);
    });
</script>
</body>
</html>