		<a href="javascript:void(0)" class="sidebar_switch on_switch ttip_r" title="Hide Sidebar">Sidebar switch</a>
		<div class="sidebar">
                <div class="antiScroll">
                    <div class="antiscroll-inner">
                        <div class="antiscroll-content">
							<div class="sidebar_inner">
								<?php
									if(isset($group->slug)){
	                                    $slug = $group->slug;
	                                }
	                                else{
	                                    $slug = "";
	                                }
	                                
	                                if(isset($group->permissions)){
	                                    $p= json_decode( $group->permissions );
	                                }
	                                else{
	                                    $p = array();
	                                }

	                                if( empty($p) )
	                                	$p = array();

	                                if( count($p) == 0 && $slug == 'admin'){
	                                	$lists = DB::table('tbmenu')->get();
	                                	if(isset($lists) && count($lists) > 0){
	                                		$p = array();
	                                		foreach($lists as $li){
	                                			$p[] = $li->role;
	                                		}
	                                	}
	                                }
	                                
	                                $dasar = DB::table('data_dasar')->where('id' , 1)->first();
								?>
								<div style="padding:10px;">
									<img style="max-height:80px;" height="80px" src="{{ url('img/'.$dasar->logo) }}" />
								</div>
								<div id="side_accordion" class="accordion">

								<?php $menus = DB::table('tbmenu')->where('parent' , 0)->where('menu_samping' , 1)->where('status' , 1)->orderBy('urutan','ASC')->get(); ?>

								@if(isset($menus) && count($menus) > 0)

									@foreach($menus as $m)
										@if(in_array($m->role , $p))
											<div class="accordion-group">
												<div class="accordion-heading">
													<a href="#menu_{{ $m->id }}" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
														<i class="{{ $m->icon }}"></i> {{ $m->nama_menu }}
													</a>
												</div>

												<div class="accordion-body collapse" id="menu_{{ $m->id }}">
													<div class="accordion-inner">
														<ul class="nav nav-list">
														<?php $subs = DB::table('tbmenu')->where('parent' , $m->id)->where('status' , 1)->
														orderBy('urutan','ASC')->get(); ?>
														@if(isset($subs) && count($subs) > 0)
															@foreach($subs as $s)
																@if(in_array($s->role , $p))
																	<li><a href="{{ url($s->url) }}"><i class="{{ $s->icon }}"></i> {{ $s->nama_menu }}</a></li>
																@endif
															@endforeach
														@endif
														</ul>
													</div>
												</div>
											</div>
										@endif
									@endforeach
								@endif


								</div>
							</div>
							   
						</div>
					</div>
				</div>
			</div>