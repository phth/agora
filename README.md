TYPO3 Extension "Agora"
===================
Agora is a forum extension **based on Extbase & Fluid** for TYPO3 CMS v6 and TYPO3 CMS v7. It brings a complete forum functionality for TYPO3 CMS based on the latest technologies.


Features
----------
The Team of Agora implemented the following features:

 - Widget: Latest threads
 - Widget: Latest posts
 - Widget: Observe threads
 - Widget: Favorite posts
 - Revision of posts
 - History of replies to posts
 - Access rights for threads and forums
 - Implementation of a markdown editor (parsedown)
 - Example configurations

#### Future features
----------
Behold the future of Agora and it's future features:

 - Dashboard-Plugin
 - Backend module for statistics
 - Quote posts
 - Frontend moderation
 - Priority of threads (pin to top)
 - Mark posts as spam
 - Custom sorting of posts/threads
 - RSS Feeds
 - Posts attachments
 - Polls per thread

Installation
----------
Agora needs to be installed like any other TYPO3 CMS extension:

 1. Switch to the module "Extension Manager".
 2. Get the extension
	 3. Get it from GitHub https://github.com/phth/agora

----------

#### **Latest version from GitHub**
To get the latest Version from GitHub use the following command:

    git clone https://github.com/phth/agora.git

 
----------

#### **Include static TypoScript**

 1. Select your root page 
 2. Select the **Backend module "Template"**
 3. Press the link "**Edit the whole template record**"
 4. Select the tab "**Includes**"
 5. Select "**Agora - TYPO3 Forum (Agora)**" from the list "Include static (from extensions)"

> ***Hint:*** *If you want to implement a configuration based on bootstrap for the editor markdown, you have to implement "**Agora - TYPO3 Forum - Bootstram Theme (agora)**" as well*

----------
#### **TypoScript**

For the frontend output you have to tell Agora where the forum data is stored. Therefore there is the constant storagePid which you need to set.

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
|Groups with read permissions|`Relation to fe_groups` A list of usergroups that can actually see and read the selected forum. If there is no entry it means, that the forum is public and cab be accessed everyone, even users thar are not logged in.|
|Groups with write permissions|`Relation to fe_groups` Same behaviour as the group with read permissions but then with writing permissions|
|Groups with modification permissions|`Relation to fe_groups` Same behaviour as the group with read permissions but then only with frontend modification rights|
|Users with read permissions|`Relation to fe_users` Same behavior as for the groups|
|Users with write permissions|`Relations to fe_users` Same behavior as for the groups|
|Users with modifications permissions|`Relations to fe_users` Same behavior as for the groups|
 
 > **Handling of permissions:** If the permissions list is empty it means that the corresponding permissions-set is set as a default for the everyone(public) . For example: If the *Group with read permissions* is empty, it means, that everybody can access and read the whole forum.

#### Threads
| Field         | Description                        |
|----------------- | ---------------------------- |
|Title| Title of the thread|
|Solved|`Not implemented yet`Option to mark a thread as solved|
|Closed|`Not implemented yet` Option to close a thread, so only moderators can publish posts|
|Sticky|`Not implemented yet` Option to stick a thread to the post of the thread list for a forum|
|Creator|`Relation to fe_users` The relation to the fe_user that created the thread|
|Posts|`Relation to posts` A list of the posts for the current thread|
|Views|`Not implemented yet`|


#### Posts
| Field         | Description                        |
|----------------- | ---------------------------- |
|Topic|Title/topic of the post|
|Text|Text of the post in markdown|
|Publishing Date|Datetime of publishing|
|Creation Date|Datetime of creation|
|Thread|`Relation to threads` The current thread the post belongs to|
|Replies|`Relation to posts` the list of replies to the current post|
|Quoted Post|`Not implemented yet` The relation to the original post, that was quoted|
|Voting|`Not implemented yet`|
|Attachments|`Not implemented yet`|
|Creator|`Relation to fe_users` The relation to the fe_user that created the post|
|Historical Versions|`Relation to posts` An historical list of versions of the posts|


Plugins
----------
There are currently 3 available plugins:

 - Forum
 - Forumpages
 - Widgets

----------------
###Forum
The forum plugin contains all functionality of the forum excluding the widgets. It contains the lists of the forum, threads and the posts, the views and the history

----------------
###Forumpages
If there are special views of the forum, they will be placed within this plugin. Currently there's only the list of "observed threads" within this plugin.

----------------
###Widgets
There are several widgets implemented within Agora:

 - Observed threads
 - Favourite Posts
 - Latest Posts
 - Latest Threads

If you want to display one of this widgets you have to implement the widget-plugin and select the functionality to display via flexform. Some of the views needs the Plugin "Forumpages" to display the lists, like the "observed threads".

Miscellaneous
=======

ChangeLog
----------

Known problems
----------
