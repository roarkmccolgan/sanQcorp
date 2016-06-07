<html>
    <head>
        <script>
            function subst() {
                var vars={};
                var x=window.location.search.substring(1).split('&');
                for (var i in x) {
                    var z=x[i].split('=',2);vars[z[0]] = unescape(z[1]);
                }
                var x=['frompage','topage','page','webpage','section','subsection','subsubsection'];
                for (var i in x) {
                    var y = document.getElementsByClassName(x[i]);
                    for (var j=0; j<y.length; ++j) y[j].textContent = vars[x[i]];
                }
            }
        </script>
    </head>
<body style="border:0; margin: 0;" onload="subst()">
    <div style="width: 210mm; height: 25mm; position: relative; background: url(http://sanqcorp.app/img/invoice/footer.jpg)">
        <div style="background-color: black; width: 13.396mm; height: 5.644mm; position: absolute; top: 7.17mm; left: 176.716mm">
            <span class="foooter page"></span> / <span class="footer topage"></span>
        </div>
    </div>
</body>
</html>