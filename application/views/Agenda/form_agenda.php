<div class="row">
    <?php
    foreach ($configs as $config){
        $id = uniqid();
        $col = isset($config['fullwidth']) ? 'col-12' : 'col-md-6';
        ?>
        <div class="<?=$col?>">
            <div class="form-group">
                <label for="<?=$id?>">
                    <?=$config['label'] ?>
                </label>
                <?php
                if (isset($config['type'])){
                    switch ($config['type']){
                        case 'datetime': {
                            ?>
                            <input name="<?=$config['name']?>" class="form-control" id="<?=$id?>" type="datetime">
                            <?php
                            break;
                        }
                        case 'select': {
                            ?>
                            <select name="<?=$config['name']?>" class="form-control" id="<?=$id?>">
                                <option disabled selected>
                                    Pilih  <?=$config['label']?>
                                </option>
                                <?php
                                foreach ($config['options'] as $option){
                                    ?>
                                    <option value="<?=$option?>">
                                        <?=$option?>
                                    </option>
                                    <?php
                                }
                                ?>
                            </select>
                            <?php
                            break;
                        }
                        case 'lstSelected':{
                            $class = str_replace('[','',$config['name']);
                            $class = str_replace(']','',$class)
                            ?>
                            <div class="border rounded">
                                <select  id="<?=$id?>" <?php if (isset($config['multiple'])) {echo 'multiple="multiple"';}?> name="<?=$config['name']?>" class="lstSelected <?=$class?>">
                                    <?php
                                    foreach ($config['options'] as $option)
                                    {
                                        ?>
                                        <option value="<?=$option['value']?>">
                                            <?=$option['label']?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <?php
                            break;
                        }
                        case 'file':{
                            ?>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupFileAddon01"><?=$config['label']?></span>
                                </div>
                                <div class="custom-file">
                                    <input
                                        name="<?=$config['name']?>"
                                        type="file"
                                        class="custom-file-input"
                                        id="inputGroupFile01"
                                        aria-describedby="inputGroupFileAddon01">
                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                </div>
                            </div>
                            <?php
                            break;
                        }
                        case 'textarea':{
                            ?>
                            <textarea name="<?=$config['name']?>"
                                      class="form-control"
                                      style="resize: none"
                                      id="<?=$id?>" cols="30" rows="5"></textarea>
                            <?php
                            break;
                        }
                    }
                }else{
                    $old =($this->session->userdata['olds']??[]);
                    $old = $old[$config['name']]??'';
                    ?>
                    <input name="<?=$config['name']?>" value="<?=$old ?>" class="form-control" id="<?=$id?>" type="text">
                    <?php
                }
                ?>
                <?php
                if (isset($errors[$config['name']])){
                    ?>
                    <div class="invalid-feedback d-block">
                        <?=$errors[$config['name']] ?>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <?php
    }
    ?>
</div>
<script type="text/javascript">
       $('input[type="file"]').change(function(e){
        var fileName = e.target.files[0].name;
        $('.custom-file-label').html(fileName);
    });
</script>
