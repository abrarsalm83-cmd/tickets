 <!-- Header -->
 <header class="header">
     <div class="nav-container">
         <a href="#" class="logo">
             <div class="logo-icon"></div>
             <span>Tickets</span>
         </a>

         <div class="user-profile">
             <div class="user-info">
                 <div class="user-name">{{ auth()->user()->name }}</div>
                 <div class="user-role">Event Organizer</div>
             </div>
             <div class="user-avatar">
                 {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}{{ strtoupper(substr(strstr(auth()->user()->name, ' '), 1, 1)) }}
             </div>

         </div>
 </header>
