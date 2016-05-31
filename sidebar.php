<div class="panel panel-success">
                            <div class="panel-heading">
                                <h3 class="panel-title">Категории</h3>
                            </div>
                            <div class="panel-body">
                                <ul>
                                <?php
                                    $stmt = $db->query('SELECT * FROM  `category` LIMIT 0 , 30');
                                    while ($row = $stmt->fetch()) {
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
                                    $stmt = $db->query('SELECT * FROM  `goods` LIMIT 0 , 30');
                                    while ($row = $stmt->fetch()) {
                                        echo "<li><a href='shop.php?good=".$row['id']."'>".$row["name"]."</a></li>";
                                    }
                                ?>
                               </ul>
                            </div>
                        </div>
