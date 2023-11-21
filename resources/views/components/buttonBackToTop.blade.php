<div id="backToTopButton" style="display: none;">↑</div>

<style>
    #backToTopButton {
        position: fixed;
        bottom: 80px;
        right: 0px;
        background-color: rgba(0, 0, 0, 0.3);
        color: var(--color-white);
        border: none;
        cursor: pointer;
        padding: 14px 8px;
        border-radius: 5px 0px 0px 5px;
    }
</style>

<script>
    window.onscroll = function () {
        //console.log("scroll sur position:", document.body.scrollTop, document.documentElement.scrollTop)
        var button = document.getElementById('backToTopButton');
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            button.style.display = "block";
        } else {
            button.style.display = "none";
        }
    };

    document.getElementById('backToTopButton').onclick = function () {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    };
</script>
