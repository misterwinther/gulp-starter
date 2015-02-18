// viewport fix
if (navigator.userAgent.match(/Windows NT 6.2; ARM(.+)Touch/)) {
    var msViewportStyle = document.createElement("style");
    msViewportStyle.appendChild(
        document.createTextNode(
            "@-ms-viewport{width:device-width}"
        )
    );
    document.getElementsByTagName("head")[0].
        appendChild(msViewportStyle);
}