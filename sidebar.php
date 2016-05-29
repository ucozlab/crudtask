<div class="panel panel-success">
                            <div class="panel-heading">
                                <h3 class="panel-title">Категории</h3>
                            </div>
                            <div class="panel-body">
                                <ul>
                                <?php
                                    mysql_query("SET NAMES UTF8");
                                    mysql_query("SET CHARACTER SET UTF8");
                                    $result = mysql_query("SELECT * FROM  `category` LIMIT 0 , 30") or die("Invalid query: " . mysql_error());
                                    while ($row = mysql_fetch_array($result)) {
                                       //echo $row["Name"].", Room ".$row["Room"].", Tel ".$row["Telephone"] ;
                                        echo "<li><a href='shop.php?category=".$row['id']."'>".$row["name"]."</a></li>";
                                    }
                                ?>
                                </ul>
                            </div>
                        </div>
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">Товары</h3>
                            </div>
                            <div class="panel-body">
                               <ul>
                                   <?php
                                    require("bd.php");
                                    mysql_query("SET NAMES UTF8");
                                    mysql_query("SET CHARACTER SET UTF8");
                                    $result = mysql_query("SELECT * FROM  `goods` LIMIT 0 , 30") or die("Invalid query: " . mysql_error());
                                    while ($row = mysql_fetch_array($result)) {
                                       //echo $row["Name"].", Room ".$row["Room"].", Tel ".$row["Telephone"] ;
                                        echo "<li><a href='shop.php?good=".$row['id']."'>".$row["name"]."</a></li>";
                                    }
                                ?>
                               </ul>
                            </div>
                        </div>
