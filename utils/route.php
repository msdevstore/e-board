<?php
    function route($url) {
        return print ('<script>window.location.href="'.$url.'.php"</script>');
    }
?>