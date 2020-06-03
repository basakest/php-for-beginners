<?php
 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     echo "接受POST数据<br />";
     foreach($_POST as $i => $v) {
         echo $i . '的值为' . $v . '<br />';
     }
 }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="keywords" content="keyword1, keyword2, keyword3" />
        <meta name="description" content="this is the description about the page" />
        <meta name="copyright" content="copyright name" />  
        <title>the title of page</title>
        
    </head>
    <body>
        <!--
        <header>
            <h1 id="test">this is the h1 tag</h1>
        </header>
        <nav>
            <a href="./page2.html" title="click it to page 2">go to page2</a>
        </nav>
        <main>
            <article>
                <h2>this is the h2 tag</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam temporibus mollitia quod quas quibusdam officia obcaecati ex dicta odit, inventore reiciendis dolorem rerum magnam iusto? Inventore quidem exercitationem similique optio?</p>
            </article>
            <aside>
                <ul>
                    <li>first unordered item</li>
                    <li>second unordered item
                        <ol>
                            <li>first ordered item</li>
                            <li>second ordered item</li>
                            <li>third ordered item</li>
                        </ol>
                    </li>
                    <li>third unordered item</li>
                </ul>
                <img src="./images/image1.jpg" alt="the alt text" />
            </aside>
        </main>
    -->
        <form action="" method="post">
            用户名：<input type="text" name="username" id=""><br />
            密码：<input type="password" name="password" id="" required><br />
            <button>提交</button>
        </form>
    </body>
</html>