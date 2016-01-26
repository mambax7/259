<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * Description: Search function for the XoopsPoll Module
 *
 * @copyright ::  {@link http://xoops.org/ XOOPS Project}
 * @license   ::    {@link http://www.fsf.org/copyleft/gpl.html GNU public license}
 * @package   ::    xoopspoll
 * @subpackage:: search
 * @since     ::      1.40
 * @author    ::     John Neill, zyspec <owners@zyspec.com>
 * @version   ::    $Id: $
 */
// defined('XOOPS_ROOT_PATH') || exit('XOOPS root path not defined');

/**
 * xoopspoll_search()
 *
 * @param        $queryArray
 * @param  mixed $andor
 * @param  mixed $limit
 * @param  mixed $offset
 * @param        $uid
 * @return array
 * @internal param mixed $queryarray
 * @internal param mixed $userid
 */
function xoopspoll_search($queryArray, $andor, $limit, $offset, $uid)
{
    $ret = array();
    if (0 === (int)($uid)) {
        xoops_load('pollUtility', 'xoopspoll');
        $pollHandler =& xoops_getmodulehandler('poll', 'xoopspoll');
        $pollFields  = array('poll_id', 'user_id', 'question', 'start_time');
        $criteria    = new CriteriaCompo();
        $criteria->add(new Criteria('start_time', time(), '<=')); // only show polls that have started
        /**
         * @todo:
         * find out if want to show polls that were created with a forum. If no, then change
         * the link to forum topic_id
         */
        /**
         * check to see if we want to include polls created with forum (newbb)
         */
        $configHandler      =& xoops_gethandler('config');
        $moduleHandler      =& xoops_gethandler('module');
        $thisModule         =& $moduleHandler->getByDirname('xoopspoll');
        $this_module_config =& $configHandler->getConfigsByCat(0, $thisModule->getVar('mid'));

        $pollsWithTopics = array();
        if (($thisModule instanceof XoopsModule) && $thisModule->isactive() && $this_module_config['hide_forum_polls']) {
            $newbbModule =& $moduleHandler->getByDirname('newbb');
            if ($newbbModule instanceof XoopsModule && $newbbModule->isactive()) {
                $topic_handler = & xoops_getmodulehandler('topic', 'newbb');
                $tFields       = array('topic_id', 'poll_id');
                $tArray        = $topic_handler->getAll(new Criteria('topic_haspoll', 0, '>'), $tFields, false);
                foreach ($tArray as $t) {
                    $pollsWithTopics[$t['poll_id']] = $t['topic_id'];
                }
            }
            unset($newbbModule);
        }

        $criteria->setSort('start_time');
        $criteria->setOrder('DESC');
        $criteria->setLimit((int)($limit));
        $criteria->setStart((int)($offset));

        if ((is_array($queryArray)) && !empty($queryArray)) {
            $criteria->add(new Criteria('question', "%{$queryArray[0]}%", 'LIKE'));
            $criteria->add(new Criteria('description', "%{$queryArray[0]}%", 'LIKE'), 'OR');
            array_shift($queryArray); //get rid of first element

            foreach ($queryArray as $query) {
                $criteria->add(new Criteria('question', "%{$query}%", 'LIKE'), $andor);
                $criteria->add(new Criteria('description', "%{$query}%", 'LIKE'), 'OR');
            }
        }
        $pollArray = $pollHandler->getAll($criteria, $pollFields, false);
        foreach ($pollArray as $poll) {
            if (array_key_exists($poll['poll_id'], $pollsWithTopics)) {
                $link = $GLOBALS['xoops']->url("modules/newbb/viewtopic.php?topic_id={$pollsWithTopics[$poll['poll_id']]}");
            } else {
                $link = "pollresults.php?poll_id={$poll['poll_id']}";
            }

            $ret[] = array(
                'image' => 'assets/images/icons/logo_large.png',
                'link'  => $link,
                'title' => $poll['question'],
                'time'  => $poll['start_time'],);
        }
    }

    return $ret;
}
