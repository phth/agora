TYPO3 Extension "agora"
===================
Agora is forum extension **based on extbase & fluid** for TYPO3 CMS v6 and TYPO3 CMS v7. It implements the functionality of a complete forum within your TYPO3 CMS based on the latest technologies.


Features
----------
The Team of Agora implemented a lot of features:

 - Widget: Latest threads
 - Widget: Latest posts
 - Widget: Observe threads
 - Widgte: Favorite posts
 - Revision of posts
 - History of replies to posts
 - Access rights for threads and forums
 - Implementation of a markdown editor (parsedown)
 - Example configurations

#### Future features
----------
The AgoraTeam already thoughed about the future of Agora and its coming features:

 - Dashboard-Plugin
 - Backend module for statistics
 - Quote posts
 - Frontend moderation
 - Priority of threads (pin to top)
 - Mark posts as spam
 - Custom sorting of posts/threads
 - RSS feeds
 - Posts attachments
 - Polls per thread

Installation
----------
Agora needs to be installed as any other TYPO3 CMS extension:

 1. Switch to the module "Extension Manager".
 2. Get the extension
	 3. Get it from GitHub https://github.com/phth/agora

----------

#### **Latest version from GitHub**
You can get the latest Version from GitHub by using the following command:

    git clone https://github.com/phth/agora.git

 
----------

#### **Include static TypoScript**

 1. Select your root page 
 2. Select the **Backend module "Template"**
 3. Press the link "**Edit the whole template record**"
 4. Select th tab "**Includes**"
 5. Select "**Agora - TYPO3 Forum (agora)**" at the list "Include static (from extensions)"

> ***Hint:*** *If you want to implement a based configuration based on bootstrap and within the editor markdown, you have to implement "**Agora - TYPO3 Forum - Bootstram Theme (agora)**" as well*

----------
#### **TypoScript**

For the frontend output you have to tell agora where the forum data is stored. Therefor there is the constant storagePid which you have to change.

 1. Select your root page
 2. Select the **Backend module "Template"**
 3. Press the link "Constants"
 4. Insert the following line to the textarea and replace the placeholder [storageId] with the storage id of your storagefolder:

   `plugin.tx_agora.persistence.storagePid = [storageId]`

Typoscript-Configuration
----------

**Plugin settings**

| Property         | Description                        | Type              | Default|
| ----------------- | ---------------------------- | ------------------|------------------|
| forum.numberOfItemsInLatestView |            | `integer` | 10 |
| forum.numberOfItemsPerPage |             | `integer` | 10 |
| forum.dateFormat |  | `string` | m-d-y h:i |
| thread.numberOfItemsInLatestView || `integer` | 10 |
| thread.numberOfItemsPerPage || `integer` | 10 |
| thread.dateFormat || `string` | m-d-y h:i |
| post.numberOfItemsInLatestView || `integer` | 10 |
| post.numberOfItemsPerPage || `integer` | 10 |
| post.dateFormat || `string` | m-d-y h:i |
| post.defaultCreatorName || `string` | Anonymous |


Templates
----------
#### Changing templates

#### Agora Viewhelper

#### Snippets

Records
----------
#### Forums

| Field         | Description                        |
|----------------- | ---------------------------- |
|Title|The title of the forum for the list view|
|Description|The description of the forum for the list view|
|SubForums|`Relation to forum` A list of forums that are subforums of the current forums|
|Parent|`Relation to forum` The title of the parent forum|
|Threads|`Relation to threads` Threads that are currently in this forum|
|Groups with read access|`Relation to fe_groups` A list of usersgroups that can actualy see and read the selected forum. If there is no entry is means, that the forum is public and displayed for everyone, even not logged in users.|
|Group with write access|`Relation to fe_groups` Same behaviour as the read access only for the write access|
|Group with modification access|`Relation to fe_groups` Same behaviour as the read access only for the frontend modification access|
|Users with read access|`Relation to fe_users` Same behavior as for the groups|
|Users with write access|`Relations to fe_users` Same behavior as for the groups|
|Users with modifications access|`Relations to fe_users` Same behavior as for the groups|
 
 > **Handling of the access rights:** If the lists an access right is empty it means, that the option of the forum is public. For example: If the *Group with read access* is empty, it means, that everybody can see and read the whole forum. 

#### Threads
| Field         | Description                        |
|----------------- | ---------------------------- |
|Title| Title for the thread|
|Solved|`Not implemented yet`Option to mark a thread as solved|
|Closed|`Not implemented yet` Option to close a thread, so that only moderator can publish posts|
|Sticky|`Not implemented yet` Option to stick the thread to the post of the thread list for a forum|
|Creator|`Relation to fe_users` The relation to the fe_user that created the thread|
|Posts|`Relation to posts` A list of the posts for the current thread|
|Views|`Not implemented yet`|


#### Posts
| Field         | Description                        |
|----------------- | ---------------------------- |
|Topic|Title/topic of the post|
|Text|Text of the post in markdown|
|Publishing Date|Datetime of the publishing date of the post|
|Creation Date|Datetime of the creation date of the post|
|Thread|`Relation to threads` The current thread the post contains to|
|Replies|`Relation to posts` A list of posts that are replies to the current one|
|Quoted Post|`Not implemented yet` The relation to the original post, that was quoted|
|Voting|`Not implemented yet`|
|Attachments|`Not implemented yet`|
|Creator|`Relation to fe_users` The relation to the fe_user that created the post|
|Historical Versions|`Relation to posts` The historical list of posts|


Plugins
----------
There are currently 3 available plugins:

 - Forum
 - Forumpages
 - Widgets

----------------
###Forum
The forum plugin contains the whole functionality of the forum excluding the widgets. It contains the lists of the forum, threads and the posts, the editation views and the histories

----------------
###Forumpages
If there are special views of the forum, they will be places within this plugin. Currently there is only the list of "observed threads" within this plugin.

----------------
###Widgets
There are several widgets implemented within agora:

 - Observed threads
 - Favorite Posts
 - Latest Posts
 - Latest Threads

If you want to display one of this widget you have to implement the widget-plugin and select the functionality to display via flexform. Some of the views needs the Plugin "Forumpages" to display the lists, like the "observed threads".

Miscellaneous
=======

ChangeLog
----------

Known problems
----------
