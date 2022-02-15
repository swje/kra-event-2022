<div class="faq">
	<div class="qna_title">
    	<h2>모바일 입장권 신청 FAQ.</h2>
        <?php if($is_end == false){ ?>
        <a href="/main/apply"><img src="/static/image/btn_apply_2.png" alt="입장권신청하기"></a>
        <?php }?>
    </div>
    <dl>
    	<dt class="first"><img src="/static/image/icon_q.png" alt="Q"></dt>
        <dd class="first"><img src="/static/image/icon_a.png" alt="A"></dd>
        <?php if(! empty($data)){
                foreach($data as $item):
        ?>
                <dt><?php echo $item['board_title'];?></dt>
                <dd><?php echo $item['board_content'];?></dd>
        <?php   endforeach;
        }?>                            
    </dl>
    <?php if($is_end == false){ ?>
    <div class="btn"><a href="/main/apply"><img src="/static/image/btn_apply_1.png" alt="입장권 신청하기"/></a></div>
    <?php }?>

</div>