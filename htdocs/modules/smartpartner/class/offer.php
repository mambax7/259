<?php
//
// ------------------------------------------------------------------------ //
//               XOOPS - PHP Content Management System                      //
//                   Copyright (c) 2000-2016 XOOPS.org                           //
//                      <https://xoops.org>                             //
// ------------------------------------------------------------------------ //
// This program is free software; you can redistribute it and/or modify     //
// it under the terms of the GNU General Public License as published by     //
// the Free Software Foundation; either version 2 of the License, or        //
// (at your option) any later version.                                      //

// You may not change or alter any portion of this comment or credits       //
// of supporting developers from this source code or any supporting         //
// source code which is considered copyrighted (c) material of the          //
// original comment or credit authors.                                      //
// This program is distributed in the hope that it will be useful,          //
// but WITHOUT ANY WARRANTY; without even the implied warranty of           //
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
// GNU General Public License for more details.                             //

// You should have received a copy of the GNU General Public License        //
// along with this program; if not, write to the Free Software              //
// Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
// ------------------------------------------------------------------------ //
// URL: https://xoops.org/                                               //
// Project: XOOPS Project                                               //
// -------------------------------------------------------------------------//

// defined('XOOPS_ROOT_PATH') || die('Restricted access');
require_once XOOPS_ROOT_PATH . '/modules/smartobject/class/smartobject.php';
require_once XOOPS_ROOT_PATH . '/modules/smartobject/class/smartobjecthandler.php';

/**
 * Class SmartpartnerOffer
 */
class SmartpartnerOffer extends SmartObject
{
    /**
     * SmartpartnerOffer constructor.
     */
    public function __construct()
    {
        $this->initVar('offerid', XOBJ_DTYPE_INT, '', true);
        $this->initVar('partnerid', XOBJ_DTYPE_INT, '', true, 255, '', false, _CO_SPARTNER_OFFER_PARTNER, _CO_SPARTNER_OFFER_PARTNER_DSC, true);
        $this->initVar('title', XOBJ_DTYPE_TXTBOX, '', true, 255, '', false, _CO_SPARTNER_OFFER_TITLE, _CO_SPARTNER_OFFER_TITLE_DSC, true);

        $this->initVar('description', XOBJ_DTYPE_TXTAREA, '', false, null, '', false, _CO_SPARTNER_OFFER_DESC, _CO_SPARTNER_OFFER_DESC_DSC);
        $this->initVar('url', XOBJ_DTYPE_TXTBOX, '', false, 255, '', false, _CO_SPARTNER_OFFER_URL, _CO_SPARTNER_OFFER_URL_DSC, true);
        $this->initVar('image', XOBJ_DTYPE_TXTBOX, '', false, null, '', false, _CO_SPARTNER_OFFER_IMAGE, _CO_SPARTNER_OFFER_IMAGE_DSC);

        $this->initVar('date_sub', XOBJ_DTYPE_INT, 0, false, null, '', false, _CO_SPARTNER_OFFER_DATESUB, _CO_SPARTNER_OFFER_DATESUB_DSC, true);
        $this->initVar('date_pub', XOBJ_DTYPE_INT, time() - 1000, false, null, '', false, _CO_SPARTNER_OFFER_DATE_START, _CO_SPARTNER_OFFER_DATE_START_DSC, true);
        $this->initVar('date_end', XOBJ_DTYPE_INT, time() + 30 * 24 * 3600, false, null, '', false, _CO_SPARTNER_OFFER_DATE_END, _CO_SPARTNER_OFFER_DATE_END_DSC, true);

        $this->initVar('status', XOBJ_DTYPE_INT, _SPARTNER_STATUS_ONLINE, false, null, '', false, _CO_SPARTNER_OFFER_STATUS, _CO_SPARTNER_OFFER_STATUS_DSC, true);
        $this->initCommonVar('weight');
        $this->initCommonVar('dohtml', false);

        $this->setControl('image', ['name' => 'image']);

        $this->setControl('date_sub', ['name' => 'date_time']);
        $this->setControl('date_pub', ['name' => 'date_time']);
        $this->setControl('date_end', ['name' => 'date_time']);

        $this->setControl('status', [
            'name'        => false,
            'itemHandler' => 'offer',
            'method'      => 'getStatus',
            'module'      => 'smartpartner'
        ]);
        $this->setControl('partnerid', [
            'itemHandler' => 'partner',
            'method'      => 'getList',
            'module'      => 'smartpartner'
        ]);
    }

    /**
     * @param  string $key
     * @param  string $format
     * @return mixed
     */
    public function getVar($key, $format = 's')
    {
        if ('s' === $format && in_array($key, ['partnerid', 'status'])) {
            //            return call_user_func(array($this, $key));
            return $this->{$key}();
        }

        return parent::getVar($key, $format);
    }

    /**
     * @return mixed
     */
    public function partnerid()
    {
        global $smartPartnerPartnerHandler;
        if (!$smartPartnerPartnerHandler) {
            $smartPartnerPartnerHandler = smartpartner_gethandler('partner');
        }
        $ret        = $this->getVar('partnerid', 'e');
        $partnerObj = $smartPartnerPartnerHandler->get($ret);

        return $partnerObj->getVar('title');
    }

    /**
     * @return mixed
     */
    public function status()
    {
        global $statusArray;
        $ret = $this->getVar('status', 'e');

        return $statusArray [$ret];
    }

    /**
     * @param array $notifications
     */
    public function sendNotifications($notifications = [])
    {
        global $smartPartnerPartnerHandler;
        $partnerObj  = $smartPartnerPartnerHandler->get($this->getVar('partnerid', 'e'));
        $smartModule = smartpartner_getModuleInfo();
        $module_id   = $smartModule->getVar('mid');

        $myts                = \MyTextSanitizer::getInstance();
        $notificationHandler = xoops_getHandler('notification');

        $tags                 = [];
        $tags['MODULE_NAME']  = $myts->displayTarea($smartModule->getVar('name'));
        $tags['PARTNER_NAME'] = $partnerObj->title(20);
        $tags['OFFER_NAME']   = $this->title(20);
        foreach ($notifications as $notification) {
            switch ($notification) {

                case _SPARTNER_NOT_OFFER_NEW:
                    $tags['OFFER_URL'] = XOOPS_URL . '/modules/' . $smartModule->getVar('dirname') . '/partner.php?id=' . $this->getVar('partnerid', 'e');
                    $notificationHandler->triggerEvent('global_partner', 0, 'new_offer', $tags);
                    break;
                case -1:
                default:
                    break;
            }
        }
    }

    /**
     * @param  string $format
     * @return array
     */
    public function toArray($format = 's')
    {
        global $myts;
        if (!$myts) {
            $myts = \MyTextSanitizer::getInstance();
        }
        $ret = parent::toArray();
        if ('e' === $format) {
            $ret['partnerid'] = $this->getVar('partnerid', 'e');
        }
        $ret['description'] = $myts->undoHtmlSpecialChars($ret['description']);

        return $ret;
    }
}

/**
 * Class SmartpartnerOfferHandler
 */
class SmartpartnerOfferHandler extends SmartPersistableObjectHandler
{
    /**
     * SmartpartnerOfferHandler constructor.
     * @param XoopsDatabase $db
     */
    public function __construct(\XoopsDatabase $db)
    {
        parent::__construct($db, 'offer', 'offerid', 'title', false, 'smartpartner');
    }

    /**
     * @return array
     */
    public function getStatus()
    {
        global $statusArray;

        return $statusArray;
    }

    /**
     * @return array
     */
    public function getObjectsForUserSide()
    {
        global $xoopsModuleConfig, $smartPartnerCategoryHandler, $smartPartnerPartnerHandler, $xoopsUser;

        $criteria = new \CriteriaCompo();
        $criteria->setSort($xoopsModuleConfig['offer_sort']);
        $criteria->setOrder($xoopsModuleConfig['offer_order']);
        $criteria->add(new \Criteria('date_pub', time(), '<'));
        $criteria->add(new \Criteria('date_end', time(), '>'));
        $criteria->add(new \Criteria('status', _SPARTNER_STATUS_ONLINE));

        $offersObj =& $this->getObjects($criteria);
        foreach ($offersObj as $offerObj) {
        }
        $catsObj     = $smartPartnerCategoryHandler->getObjects(null, true);
        $partnersObj = $smartPartnerPartnerHandler->getObjects(null, true);

        require_once XOOPS_ROOT_PATH . '/modules/smartobject/class/smartobjectpermission.php';
        $smartPermissionsHandler = new SmartobjectPermissionHandler($smartPartnerPartnerHandler);
        $userGroups              = is_object($xoopsUser) ? $xoopsUser->getGroups() : XOOPS_GROUP_ANONYMOUS;
        $grantedItems            = $smartPermissionsHandler->getGrantedItems('full_view');
        $relevantCat             = [];

        foreach ($offersObj as $offerObj) {
            if (in_array($offerObj->getVar('partnerid', 'e'), $grantedItems)) {
                $categId        = $partnersObj[$offerObj->getVar('partnerid', 'e')]->categoryid();
                $parentCatArray = explode('|', $categId);
                $relevantCat    = array_merge($relevantCat, $parentCatArray);
                foreach ($parentCatArray as $p_cat) {
                    $parentid = $p_cat;
                    while (0 != $catsObj[$parentid]->parentid()) {
                        $parentid      = $catsObj[$parentid]->parentid();
                        $relevantCat[] = $parentid;
                    }
                }
            }
        }
        $relevantCat = array_unique($relevantCat);

        $partnersArray = [];
        foreach ($partnersObj as $partnerObj) {
            $grantedGroups = $smartPermissionsHandler->getGrantedGroups('full_view', $partnerObj->id());
            if (array_intersect($userGroups, $grantedGroups)) {
                $partnerArray           = [];
                $partnerArray['name']   = $partnerObj->title();
                $partnerArray['offers'] = [];
                foreach ($offersObj as $offerObj) {
                    if ($offerObj->getVar('partnerid', 'e') == $partnerObj->id()) {
                        $partnerArray['offers'][] = $offerObj->toArray();
                    }
                }
                $partnersArray[$partnerObj->id()] = $partnerArray;
                unset($partnerArray);
            }
        }

        $categoriesArray = [];
        foreach ($catsObj as $catObj) {
            if (in_array($catObj->categoryid(), $relevantCat)) {
                $categoryArray               = [];
                $categoryArray['parentid']   = $catObj->parentid();
                $categoryArray['categoryid'] = $catObj->categoryid();
                $categoryArray['name']       = $catObj->name();
                $categoryArray['partners']   = [];
                foreach ($partnersObj as $partnerObj) {
                    $catArray = explode('|', $partnerObj->categoryid());
                    if (in_array($catObj->categoryid(), $catArray)) {
                        $categoryArray['partners'][$partnerObj->id()] = $partnersArray[$partnerObj->id()];
                    }
                }
                $categoriesArray[] = $categoryArray;
                unset($categoryArray);
            }
        }

        return $this->hierarchize($categoriesArray);
    }

    /**
     * @param        $categoriesArray
     * @param  int   $parentid
     * @return array
     */
    public function hierarchize($categoriesArray, $parentid = 0)
    {
        $hierachizedArray = [];
        foreach ($categoriesArray as $cat) {
            if ($cat['parentid'] == $parentid) {
                $id                               = $cat['categoryid'];
                $hierachizedArray[$id]            = $cat;
                $hierachizedArray[$id]['subcats'] = $this->hierarchize($categoriesArray, $cat['categoryid']);
            }
        }

        return $hierachizedArray;
    }

    /**
     * @param $category
     * @return bool
     */
    public function hasOffer($category)
    {
        $partners = $category['partners'];
        $subcats  = $category['subcats'];
        $hasoffer = false;
        foreach ($partners as $partner) {
            if (isset($partner['offers'])) {
                $hasoffer = true;
            }
        }
        if ((!$hasoffer || !$partners) && !$subcats) {
            return false;
        }
        foreach ($partners as $partner) {
            if ($partner['offers']) {
                return true;
            }
        }
        foreach ($subcats as $subcat) {
            return hasOffer($subcat);
        }
    }

    /**
     * @return mixed
     */
    public function getPartnerList()
    {
        global $smartPartnerPartnerHandler;

        return $smartPartnerPartnerHandler->getList();
    }

    /**
     * @return array
     */
    public function getstatusList()
    {
        global $statusArray;

        return $statusArray;
    }
}
