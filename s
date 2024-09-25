
                              
                                    <?php
                                    $countQuery = $dbh->query("SELECT COUNT(*) AS user_count FROM users");
                                    $userCount = $countQuery->fetch(PDO::FETCH_ASSOC)['user_count'];
                                    ?>
                                    <span class="right badge badge-danger"><h3><?= $userCount; ?></h3></span>
                                </p>