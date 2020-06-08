<!DOCTYPE html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message = "";
    foreach ($_POST as $i => $v) {
        $message .= $i . "的值为" . $v;
    }
    $dbc = mysqli_connect("127.0.0.1", "root", "201916ab", "test");
    $sql = "insert into message(message) values('$message')";
    $result = $dbc->query($sql);
    if ($result) {
        echo "保存成功";
    } else {
        echo "保存失败";
    }
}
?>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>form</title>
    </head>
    <body>
        <h1>预定会议</h1>
        <form method="post">
            <div>
                <label id="subject">会议主题</label>
                <input type="text" name="subject" id="subject">
            </div>
            <div>
                <p>开始时间</p>
                <input type="date" name="start-time-date">
                <input type="time" name="start-time-time">
            </div>
            <div>
                <p>结束时间</p>
                <input type="date" name="end-time-date">
                <input type="time" name="end-time-time">
            </div>
            <div>
                <p>日历</p>
                <input type="radio" name="calendar">Outlook
                <input type="radio" name="calendar">其他日历
            </div>
            <div>
                <p>会议人数上限</p>
                <input type="number" name="max_number" value="300"><a href="#">扩容</a>
            </div>
            <div>
                <p>入会密码</p>
                <input type="checkbox" name="password">开启会议密码
            </div>
            <div>
                <p>文档<a href="#">点击添加</a></p>
                <input type="checkbox" name="document_allowed">允许成员上传文档
            </div>
            <button>预定</button>
        </form>
    </body>
</html>