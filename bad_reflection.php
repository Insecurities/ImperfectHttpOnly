<html>
    <h3>This is an example of how cookies can be read onto the page via PHP</h3>

    <p><h4>Reading the user cookies from the request header:</h4></p>
    <?php
    print_r(urlencode(getallheaders()['Cookie']));
    ?>
    <p><u>Code snippet:</u>
    <pre>
// Dev note, this is reading from the cookie and performing URL encoding
print_r(urlencode(getallheaders()['Cookie']));</pre></p>
</html>