<!DOCTYPE html PUBLIC="https://ntaurus.com">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
        <title>职工表管理</title>
        <meta charset="UTF-8">
        <!-- 樱花特效 -->
        <!-- <script src="./cherry.js"></script> -->
        <!-- 爱心特效 -->
        <!-- <script src="./clicklove.js"></script> -->
        <!-- 按钮样式 -->

        <!-- 调用按钮的样式文件css -->
        <link rel="stylesheet" href="./buttons.css" type="text/css" media="screen">

        <!-- 样式跟布局 -->
        <style>
            .container{
                width: 50%;
                margin: 20px auto;
            }
            .common{
                width:230px;
                height: 30px;
            }
            span{
                display:inline-block;
                width: 150px;
                text-align: right;
            }
            div{
                margin-bottom: 10px;
            }
        </style>

    </head>

    <body>

        <form class="container" method="post">
        <div>
            <span>工 号</span>
            <input type="text" name="worker_Id" class="common" value=""/>
            <font color="red">(范围：9000~10000)</font>
        </div>
    
        <div>
            <span>名 字</span>
            <input type="text" name="worker_Name" class="common" value=""/> 
            <font color="red">(必填)</font>
        </div>  

        <div>
            <span>密 码</span>
            <input type="text" name="password" class="common" value=""/>
            <font color="red">(不超过8位)</font>
        </div>

        <div>
            <span>电 话</span>
            <input type="text" name="phone" class="common" value=""/>
            <font color="red">(必填)</font>
        </div>

        <div>
            <span >性 别</span>
            <select class="common" name="sex">
                <option value="男">男</op   tion>
                <option value="女" selected="selected">女</option>
            </select>
        </div>

        <div>
            <span >部 门</span>
            <select class="common" name="section">
                <option value="人事部">人事部</option>
                <option value="研发部" selected="selected">研发部</option>
                <option value="生产部">生产部</option>
                <option value="销售部">销售部</option>
            </select>
            
        </div>

        <div>
            <span>职 位</span>
            <input type="text" name="position" class="common" value=""/>
        </div>

            <?php
                $link  = mysqli_connect("localhost",  "root", "Limit0502","buffetsystem");
                if(!empty($_GET['worker_Id']&&$_GET['action']=="删除")){    //删除表钟记录
                    $worker_Id = $_GET['worker_Id']; //获取主键
                    $sql = "delete from tb_worker where worker_Id = '$worker_Id'";
                    if(!mysqli_query($link,$sql)){  //执行sql命令
                        exit('执行失败'.mysqli_error($link));
                    }
                }
                if(!empty($_POST)&&$_POST['button']=="提交"){   //添加表记录
                    $sql = "insert into tb_worker(worker_Id, worker_Name, sex, section, position, phone,password) values('"
                    .$_POST['worker_Id'] ."','" .$_POST['worker_Name'] ."','" .$_POST['sex'] ."','" .$_POST['section']
                    ."','" .$_POST['position'] ."'," .$_POST['phone'] .",'" .$_POST['password']  ."')";
                    // echo $sql;   //查看sql语句是否正确
                    if(!mysqli_query($link,$sql)){
                        exit('执行失败'.mysqli_error($link));
                    }
                }
            ?>


        <div>
            <span></span>     
               <!-- 添加提交按钮 -->
            <button class="cupid-green"  onclick="" name="button" value="提交">提交</button>
        </div>

        <div>
            <span></span>
            <font color="red"><?php echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" ?>显示数据</font>
        </div>

        <!-- 表格 -->
        <div>
            <table border="1" cellspacing="2" width="600" class="hovertable">
                <!-- 表头 -->
                <tr>
                    <td>工号</td>
                    <td>名字</td>
                    <td>性别</td>
                    <td>部门</td>
                    <td>职位</td>
                    <td>电话</td>
                    <td>密码</td>
                    <td>操作</td>
                </tr>
                <!-- 获取数据库钟tb_worker表的数据 -->
                    <?php
                        // **连接数据库**//
                        $link  = mysqli_connect("localhost",  "root", "Limit0502","buffetsystem");
                        $result=mysqli_query($link,'select *from tb_worker;');
                        while($row=mysqli_fetch_assoc($result)){
                            // **以表格形式输出每条数据**//
                            echo "<tr> <td>{$row['worker_Id']}</td> <td>{$row['worker_Name']}</td>"
                            ."<td>{$row['sex']}"
                            ."</td>  <td>{$row['section']} </td> <td>{$row['position']}</td>"   
                            ."<td>{$row['phone']}</td> <td>{$row['password']}</td>"
                            //删除操作的添加
                            ."<td> <a href='?worker_Id={$row['worker_Id']} & action=删除' onclick="
                            ."'return queren()'>删除</a>"
                            //修改操作的添加（./worker_update.php打开修改的页面）
                            ."<a href='./worker_update.php?worker_Id={$row['worker_Id']}" //传主键workder_Id
                            ."& action=修改' >&nbsp 修改</a></td> </tr>";
                        }
                    ?>
            </table>
        </div>

        </form>

    <!-- 删除确认弹窗 -->
        <script>
        function queren(){
            var is = window.confirm("你真的要删除吗?");//只能返回true或false
            return is===true?true:false;
        }
        </script>
    </body>

</html>