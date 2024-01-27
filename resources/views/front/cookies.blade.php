<style>
    /* GDPR Cookie dialog */
    .gdprcookie * {
        padding: 0;
        margin: 0;
        border: none;
    }
    .gdprcookie h1, h2 {
        color: #0284be;
        font: bold 1.5em Quicksand,sans-serif;
        margin-bottom: 1rem;
    }
    .gdprcookie h2 {
        font-size: 1.2em;
        margin-bottom: 1rem;
    }
    .gdprcookie p {
        margin-bottom: 1rem;
        line-height: 1.75em;
    }
    .gdprcookie code {
        color: #007fb9;
        font: .8em monospace;
        background: #f7f7f7;
        padding: .15rem .25rem;
        border-radius: .15rem;
        border: .05rem solid #ebebeb;
    }
    .gdprcookie {
        position: fixed;
        color: white;
        font-size: .8em;
        line-height: 1.8em;
        right: 3.0rem;
        bottom: 3.0rem;
        max-width: 35em;
        padding: 1rem;
        background: black;
        /*font-size: 115%;*/
        z-index: 999999;
    }
    .gdprcookie-intro ,.gdprcookie-types{
        padding: 0;
        margin: 0;
        border: none;
    }
    .gdprcookie h1,
    .gdprcookie h2 {
        font-size: 1.2em;
        margin-bottom: .5rem;
    }
    .gdprcookie h2 {
        font-size: 1.2em;
    }
    .gdprcookie a {
        color: inherit;
    }
    .gdprcookie p {
        margin-bottom: 1rem;
        line-height: 1.75em;
    }

    /* GDPR Cookie buttons */

    .gdprcookie-buttons {
        text-align: center;
    }
    .gdprcookie-buttons button {
        color: white;
        font-family: inherit;
        font-size: 1em;
        padding: .5rem;
        border: solid .05rem currentColor;
        border-radius: .15rem;
        margin: 0 .2rem;
        background: #015a8e;
        cursor: pointer;
    }
    .gdprcookie-buttons button:disabled {
        color: rgba(255,255,255,.5);
    }


    /* GDPR Cookie types */

    .gdprcookie-types ul {
        overflow: hidden;
        padding: 0;
        margin: 0 0 1rem;
    }
    .gdprcookie-types li {
        display: block;
        list-style: none;
        float: left;
        width: 50%;
        padding: 0;
        margin: 0;
    }
    .gdprcookie-types input[type=checkbox] {
        margin-right: .25rem;
    }
</style>

<script src="{{ asset('js/cookies.js') }}"></script>
<script>
    $.gdprcookie.init({
        title: "🍪 Aceptar cookies y política de privacidad?",
        message: "FORMACIÓN DE ANAPAT utiliza cookies propias para recopilar información que ayuda a optimizar su visita a sus páginas web. No se utilizarán las cookies para recoger información de carácter personal. Usted puede permitir su uso o rechazarlo, también puede cambiar su configuración siempre que lo desee. Encontrará más información en nuestra <a style='color:#4ea7d9' href={{route('cookies')}}>Política de Cookies</a>.",
        delay: 600,
        expires: 1,
        acceptBtnLabel: "Aceptar cookies",
    });

    $(document.body)
        .on("gdpr:show", function() {
            console.log("Cookie dialog is shown");
        })
        .on("gdpr:accept", function() {
            var preferences = $.gdprcookie.preference();
            console.log("Preferences saved:", preferences);
        })
        .on("gdpr:advanced", function() {
            console.log("Advanced button was pressed");
        });

    if ($.gdprcookie.preference("marketing") === true) {
        console.log("This should run because marketing is accepted.");
    }
</script>
<script type="text/javascript">

    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-36251023-1']);
    _gaq.push(['_setDomainName', 'jqueryscript.net']);
    _gaq.push(['_trackPageview']);

    (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();

</script>
