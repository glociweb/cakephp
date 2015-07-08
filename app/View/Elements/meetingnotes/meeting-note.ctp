<?php
   /**
    * 
    * ClientEngage: ClientEngage Project Platform (http://www.clientengage.com)
    * Copyright 2012, ClientEngage (http://www.clientengage.com)
    *
    * You must have purchased a valid license from CodeCanyon in order to have 
    * the permission to use this file.
    * 
    * You may only use this file according to the respective licensing terms 
    * you agreed to when purchasing this item on CodeCanyon.
    * 
    * 
    * 
    *
    * @author          ClientEngage <contact@clientengage.com>
    * @copyright       Copyright 2012, ClientEngage (http://www.clientengage.com)
    * @link            http://www.clientengage.com ClientEngage
    * @since           ClientEngage - Project Platform v 1.0
    * 
    */
   ?> 
<input style="display:none" id="fileupload" type="file" name="files[]" multiple>  
<input placeholder="Enter Note title" value="{title}" name="data[Notes][title]" class="note_title" maxlength="255" type="text" id="NotesTitle"><br>
<h2 class="border-none" contenteditable="true">Date</h2>
<input style="display:none;" class="datepicker">
<p>﻿<time class="non-editable" datetime="2015-06-27" contenteditable="false" onselectstart="return false;">{date}</time>﻿</p>
<h2 class="border-none" contenteditable="true">Attachments</h2>
<div id="attachments-wrapper" class="text-placeholder border-none" data-text="attach files to notes">
   <div class="attach-file dropdown" style="display: block;">
      <a aria-expanded="true" data-toggle="dropdown" href="javascript:;">
      <span class="icon-ts-files"></span><span class="ts-files link">Select files</span></a>
      <ul class="subattachFile popup dropdown-menu dm-icon pull-left">
         <li><a data-id="1" class="link" onclick="noteAttachlocal()" id="pick">From Local Computer</a></li>
         <li><a data-id="2" class="link" id="googlepicker">From google drive</a></li>
         <li><a id="uDropBoxLink" class="link" onclick="noteAttachdb()">From dropbox</a></li>
      </ul>
   </div>
   <div id="attachments"></div>
</div>
<h2 class="border-none" contenteditable="true">Attendees</h2>
<div contenteditable="true" id="mention-text" type="text" class="user-depart-list text-placeholder border-none" data-text="add users as an attendee(@for user #for a department's users)." ></div>
<div id='display-dept'></div>
<div id="msgbox-dept"></div>
<h2 class="border-none" contenteditable="true">Goals</h2>
<div class="editable">Set goals, objectives or some context for this meeting.</div>
<h2 class="border-none" contenteditable="true">Discussion items</h2>
<div class="editable">
   <table style="border:1px solid #e2e2e2;" class="table" >
      <tbody>
         <tr>
            <th class="confluenceTh">Time</th>
            <th class="confluenceTh">Item</th>
            <th class="confluenceTh">Who</th>
            <th class="confluenceTh">Notes</th>
         </tr>
         <tr>
            <td class="confluenceTd"><span class="text-placeholder">5min</span></td>
            <td class="confluenceTd"><span class="text-placeholder">Agenda item</span></td>
            <td class="confluenceTd"><span class="text-placeholder">Name</span></td>
            <td class="confluenceTd">
               <ul>
                  <li><span class="text-placeholder">Notes for this agenda item</span></li>
               </ul>
            </td>
         </tr>
         <tr>
            <td class="confluenceTd"><br></td>
            <td class="confluenceTd"><br></td>
            <td class="confluenceTd"><br></td>
            <td class="confluenceTd"><br></td>
         </tr>
      </tbody>
   </table>
</div>
<h2 class="border-none" contenteditable="true">Action items</h2>
<div contenteditable="true" id="action-text" type="text" class="userlist text-placeholder border-none" data-text="Type your task here. Use @ to assign a user." ></div>
<div id='display'></div>
<div id="msgbox"></div>
<div class="action-wrapper">
</div>

