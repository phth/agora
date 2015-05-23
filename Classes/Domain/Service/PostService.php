<?php
namespace AgoraTeam\Agora\Domain\Service;


    /***************************************************************
     *
     *  Copyright notice
     *
     *  (c) 2015 Philipp Thiele <philipp.thiele@phth.de>
     *           Björn Christopher Bresser <bjoern.bresser@gmail.com>
     *
     *  All rights reserved
     *
     *  This script is part of the TYPO3 project. The TYPO3 project is
     *  free software; you can redistribute it and/or modify
     *  it under the terms of the GNU General Public License as published by
     *  the Free Software Foundation; either version 3 of the License, or
     *  (at your option) any later version.
     *
     *  The GNU General Public License can be found at
     *  http://www.gnu.org/copyleft/gpl.html.
     *
     *  This script is distributed in the hope that it will be useful,
     *  but WITHOUT ANY WARRANTY; without even the implied warranty of
     *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
     *  GNU General Public License for more details.
     *
     *  This copyright notice MUST APPEAR in all copies of the script!
     ***************************************************************/

/**
 * PostService
 */
class PostService {

    /**
     * @var \TYPO3\CMS\Extbase\Object\ObjectManagerInterface
     */
    protected $objectManager;

    /**
     * Injects the object manager
     *
     * @param \TYPO3\CMS\Extbase\Object\ObjectManagerInterface $objectManager
     * @return void
     */
    public function injectObjectManager(\TYPO3\CMS\Extbase\Object\ObjectManagerInterface $objectManager) {
        $this->objectManager = $objectManager;
        $this->arguments = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\Arguments');
    }

    /**
     * clone
     *
     * @todo find a better/more elegant way to do this, maybe with EXT:tool
     *
     * @param \AgoraTeam\Agora\Domain\Model\Post $originalPost The original Post
     * @return \AgoraTeam\Agora\Domain\Model\Post $post
     */
    public function copy(\AgoraTeam\Agora\Domain\Model\Post $originalPost) {
        /** @var \AgoraTeam\Agora\Domain\Model\Post $post */
	    $post = $this->objectManager->get('AgoraTeam\\Agora\\Domain\\Model\\Post');

        $post->setPublishingDate($originalPost->getPublishingDate());
        $post->setTopic($originalPost->getTopic());
        $post->setText($originalPost->getText());
        if(is_a($originalPost->getCreator(),'\AgoraTeam\Agora\Domain\Model\User')) {
            $post->setCreator($originalPost->getCreator());
        }
        if(is_a($originalPost->getQuotedPost(),'\AgoraTeam\Agora\Domain\Model\Post')) {
            $post->setQuotedPost($originalPost->getQuotedPost());
        }
        if(is_a($originalPost->getThread(),'\AgoraTeam\Agora\Domain\Model\Thread')) {
            $post->setThread($originalPost->getThread());
        }

	    $post->setHistoricalVersions($originalPost->getHistoricalVersions());

        return $post;
    }

    /**
     * archive
     *
     * @param \AgoraTeam\Agora\Domain\Model\Post $post The post to archive
     * @return void
     */
    public function archive(\AgoraTeam\Agora\Domain\Model\Post $post) {
        // detach thread so that an archived post will not shown up in thread history
        $post->setThread(NULL);

        //$emptyReplyStorage = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage');
        //$post->setReplies($emptyReplyStorage);
    }

}