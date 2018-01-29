<div class="doi-tac col-md-12 col-sm-12">
            	<div class="tit-noibat">
                        	<a href="" title=""><?=lang('part')?></a>
                        </div>
                <div class="dvnb_content sp_tieubieu col-md-12  col-sm-12 col-xs-12">
                                        <ul id="flexiselDemo5">
                                        <?php if(isset($slidee)){
                                                  foreach($slidee as $slie){?>
                                            <li>
                                                <div class="img">
                                                    <a href="#"><img src="<?=base_url($slie->link)?>" /></a>
                                                </div>
                                                
                                            </li>
                                        <?php }}?>
                                           
                                        </ul>
                           </div>
            </div><!--end doi-tac-->
            