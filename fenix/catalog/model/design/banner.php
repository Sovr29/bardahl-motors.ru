<?php
class ModelDesignBanner extends Model {
	public function getBanner($banner_id) {
		$query = $this->db->query("(SELECT * FROM " . DB_PREFIX . "banner_image bi LEFT JOIN " . DB_PREFIX . "banner_image_description bid ON (bi.banner_image_id  = bid.banner_image_id) WHERE bi.banner_id = '" . (int)$banner_id . "' AND bid.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY sort_order ASC)
                union all
                (select
		p.promotion_id as banner_image_id,
		0 as banner_id,
		concat( 'index.php?route=information/promotions/promotion&promotion_id=', pp.promotion_id ) AS link,
		pd.title as link_title,
		p.image as image,
		'' as sort_order,
		0 as banner_image_id,
		0 as language_id,
		0 as banner_id,
		pd.title as title
                from " . DB_PREFIX . "promotions p
                inner join " . DB_PREFIX . "promotions_periods pp on pp.promotion_id = p.promotion_id
                left outer join " . DB_PREFIX . "promotions_description pd on pd.promotion_id = p.promotion_id
                where p.status = 1 and p.show_on_main_page = 1 and (CURDATE() between pp.date_begin and pp.date_end)
                ORDER BY pp.date_begin, pp_date_end)
                ORDER BY sort_order ASC");

		return $query->rows;
	}
}