<?php
if (empty($album) and get_post_type() == 'stm_albums') $album = get_the_ID();

if (!empty($album)):
    $player_cols = 'col-md-12';
    $album_links = get_post_meta($album, 'album_links', true);
    if (has_post_thumbnail($album) or !empty($album_links)) {
        $player_cols = 'col-md-6';
    };
    $playlist = pearl_create_playlist($album);
    ?>
    <div class="stm_flex stm_flex_last stm_album_info__top stm_flex_align_items_center">
        <?php if (!empty($title)): ?>
            <h2><?php echo sanitize_text_field($title); ?></h2>
        <?php endif; ?>
    </div>
    <div class="row">
        <?php if (has_post_thumbnail($album) or !empty($album_links)): ?>
            <div class="col-md-6">
                <div class="stm-album-info--left">
                    <?php echo html_entity_decode(pearl_get_VC_img(get_post_thumbnail_id($album), '750x750')); ?>
                </div>
            </div>
        <?php endif; ?>
        <div class="<?php echo esc_attr($player_cols); ?>">
            <?php if (!empty($playlist)): ?>
                <div class="stm_album_info__playlist">
                    <?php foreach ($playlist as $index => $song): ?>
                        <div class="stm_album_info__song"
                             data-album-id="<?php echo intval($album); ?>"
                             data-album-title="<?php echo esc_attr(get_the_title($album)); ?>"
                             data-song-title="<?php echo esc_attr($song['title']); ?>"
                             data-length="<?php echo (!empty($song['length'])) ? sanitize_text_field($song['length']) : ''; ?>"
                             data-album-song="<?php echo esc_url($song['url']); ?>">
                            <div class="stm_album_info__song_number">
                                <span class="number"><?php echo intval($index + 1); ?>.</span>
                                <div class="audio-bodong">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                                <div class="audio-pause"><i class="fa fa-play"></i></div>
                            </div>
                            <div class="stm_album_info__song_title"><?php echo sanitize_text_field($song['title']); ?></div>
                            <div class="stm_album_info__song_links">
                                <?php foreach ($song['urls'] as $url): ?>
                                    <a href="<?php echo esc_url($url['url']) ?>" target="_blank" rel="nofollow">
                                        <i class="<?php echo esc_attr($url['icon']) ?>"></i>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                            <div class="stm_album_info__song_length"><?php echo sanitize_text_field($song['length']); ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>