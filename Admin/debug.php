<div class="replies" style="display: none;">
                                                                                        <!-- replies -->

                                                                                                <ul class="timeline">

                                                                                                <?php
                                                                                                        $getCommentByThisPost = "SELECT * FROM sqlcommunity_interaction.replies WHERE comment_id = $comment_id ORDER BY id DESC";
                                                                                                        $queryCommentByThisPost = mysqli_query($conn, $getCommentByThisPost);

                                                                                                        while ($resultCommentByThisReply = mysqli_fetch_assoc($queryCommentByThisPost)) {
                                                                                                            $commentDateTime = new DateTime($resultCommentByThisReply['reply_date']); // assuming 'created_at' is the timestamp column
                                                                                                            $currentDateTime = new DateTime();
                                                                                                            
                                                                                                        
                                                                                                            $interval = $currentDateTime->diff($commentDateTime);

                                                                                                        
                                                                                                            if ($interval->days == 0) {
                                                                                                            
                                                                                                                $dateString = "today";
                                                                                                                $timeString = $commentDateTime->format("H:i"); 
                                                                                                            } else {
                                                                                                            
                                                                                                                $dateString = $commentDateTime->format("Y-m-d");
                                                                                                                $timeString = $commentDateTime->format("H:i");
                                                                                                            }
                                                                                                    ?>

                                                                                                <li>
                                                                                                        <div class="timeline-time">
                                                                                                            <span class="date" style="color: #003C43;"><?php echo $dateString; ?></span>
                                                                                                            <span class="time" style="color: #003C43;"><?php echo $timeString; ?></span>
                                                                                                        </div>
                                                                                                    </li>
                                                                                                    
                                                                                                        <div class="timeline-icon">
                                                                                                            <a href="javascript:;">&nbsp;</a>
                                                                                                        </div>
                                                                                                        
                                                                                                        <div class="timeline-body" style = "width: 78%; box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.5);">
                                                                                                            <div class="timeline-header">
                                                                                                                <?php
                                                                                                                       $replier_id = $resultCommentByThisReply['reply_by'];
                                                                                                                       $selectInfoBasedOnReplier = "SELECT * FROM sqlcommunity_main.admin_account WHERE id = $replier_id";
                                                                                                                        $queryBasedOnReplier = mysqli_query($conn,$selectInfoBasedOnReplier);

                                                                                                                        $fetchResult = mysqli_fetch_assoc($queryBasedOnReplier);
                                                                                                                ?>
                                                                                                                <span class="userimage"><img src="<?php echo $fetchResult['profile_picture']; ?>" alt=""></span>
                                                                                                                <span class="username"><a href="javascript:;"><?php echo $fetchResult['fullname']; ?></a> <small></small></span>
                                                                                                                
                                                                                                            </div>
                                                                                                            <div class="timeline-content">
                                                                                                                    <p><?php 
                                                                                                                         echo $resultCommentByThisReply['message'];
                                                                                                                    ?></p>
                                                                                                
                                                                                                                
                                                                                                                    
                                                                                                                
                                                                                                                <div class="stats-right">
                                             
                                                                                                                </div>

                                                                                                            

                                                                                                                <style>
                                                                                                                    .stats-right {
                                                                                                                                float: right;
                                                                                                                                color: #78B3CE;
                                                                                                                                font-weight: bolder;
                                                                                                                            }

                                                                                                                </style>

                                                                                                            </div>
                                                                                                            <div class="timeline-likes">
                                                                                                            
                                                                                                                <div class="stats">
                                                                                                                
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            
                                                                                                          

                                                                                                                
                                                                                                            
                                                                                                        </div>
                                                                                                
                                                                                                        </li>

                                                                                                        <?php  } ?>

                                                                                                </ul>   


                                                                                        <!-- end sa replies -->
                                                                            </div>
                                                                    
                                                                </div>