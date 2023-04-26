                      <div class="media">
                        <div class="media-object avatar avatar-md mr-4" style="background-image: url(<?php echo $model->img; ?>)"></div>
                        <div class="media-body">
                          <div class="media-heading">
                            <small class="float-right text-muted"><?php echo $model->date_create; ?></small>
                            <h5><a href="/materials/default/read/<?php echo $model->id; ?>"><?php echo $model->title; ?></a></h5>
                          </div>
                          <div>
                            <?php echo $model->description; ?>
                          </div>
                        </div>
                      </div>