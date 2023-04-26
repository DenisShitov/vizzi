                <div class="card card-aside animated fadeIn">
                  <a href="/materials/default/read/<?php echo $model->id; ?>" class="card-aside-column" style="background-image: url(<?php echo $model->img; ?>)"></a>
                  <div class="card-body d-flex flex-column">
                    <h5 style="font-size:14px;"><i class="" title="" aria-hidden="true"></i> <a href="/materials/default/read/<?php echo $model->id; ?>"><?php echo $model->title; ?></a></h5>
                    <div class="text-muted" style="font-size: 12px;min-height: 100px;"><p><?php echo $model->description; ?></p></div>
                    <div class="d-flex align-items-center pt-5 mt-auto">
                      <div class="user-info">
						<?php echo $model->date_create; ?>
                      </div>
                      <div class="ml-auto text-muted">
                        <button data-content="<?php echo $model->id; ?>" data-toggle="tooltip" data-original-title="Добавить в избранное" class="icon d-none d-md-inline-block ml-3 favbtn" type="button"><i class="fe fe-heart mr-1"></i></button>
                      </div>
                    </div>
                  </div>
                </div>