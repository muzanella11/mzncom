<div class="col-lg-12" style="font-size:50pt; color:tomato; text-align:center;">
    Success bot :)
    <?php
        $a = $this->uri->segment(1);
        echo $a;
    ?>
</div>
<div class="col-lg-12" style="font-size:30pt; color:tomato; text-align:center;">
    Success add <?php echo $enem_bot_total; ?> data <br>
    Total data bot <?php echo count($dataBot); ?>
</div>
<div class="col-lg-12" style="font-size:12pt; color:tomato; text-align:center;">
    Process time <?php echo $getRunTime; ?>
</div>
<div style="text-align:center;">
    <?php
        // for ($i=0; $i < 1001; $i++) {
        //     $nomer = $i + 1;
        //     $string = 'a';
        //     $alphabet = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j');
        //     echo $nomer .'.&nbsp;'.$string.'<br>';
        // }
        // $alphabet = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j');
        // var_dump($alphabet); exit();
    ?>
</div>
<div style="text-align:center;">
    <?php
        for ($i=0; $i < 10; $i++) {
            $nomer = $i + 1;
            $string = 'a';
            $alphabet = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j');
            echo $nomer .'.&nbsp;'.$alphabet[$i].'<br>';
        }
        // $alphabet = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j');
        // var_dump($alphabet); exit();
    ?>
</div>