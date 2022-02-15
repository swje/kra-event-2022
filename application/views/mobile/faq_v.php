<div class="faq">
	<div class="qna_title">
    	<h2>모바일 입장권 신청 FAQ.</h2>       
    </div>
    <dl>
<?php if(! empty($data)){
        foreach($data as $item):
?>
        <dt><img src="/static-m/image/icon_q.png" alt="Q"><span><?php echo $item['board_title'];?></span></dt>
        <dd><?php echo $item['board_content'];?></dd>
<?php   endforeach;
}?>                                     
    </dl>
    <?php if($is_end == false){ ?>
	<div class="btn"><a href="/main/apply"><img src="/static-m/image/btn_apply_2.png" alt="입장권신청하기"></a></div>
	<?php }?>
</div>