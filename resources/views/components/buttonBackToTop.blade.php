<div id="backToTopButton" style="display: none;">↑</div>

<style>
    #backToTopButton {
        position: fixed;
        bottom: 80px;
        right: 0px;
        background-color: rgba(0, 0, 0, 0.1);
        -webkit-backdrop-filter: blur(15px);
        backdrop-filter: blur(15px);
        cursor: pointer;
        padding: 14px;
        border-radius: 5px 0px 0px 5px;
        font-size: 1.5rem;
        color: var(--color-text70);
    }

    @media (min-width: 700px) {
        #backToTopButton {
            bottom: 7rem;
        }
        #backToTopButton::before {
            content: "Haut ";
            color: var(--color-text70);
        }
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
