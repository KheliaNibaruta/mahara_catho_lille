<?php // $Id: odbc_mssql.class.php,v 1.1 2006/10/09 22:29:52 stronk7 Exp $

///////////////////////////////////////////////////////////////////////////
//                                                                       //
// NOTICE OF COPYRIGHT                                                   //
//                                                                       //
// Moodle - Modular Object-Oriented Dynamic Learning Environment         //
//          http://moodle.com                                            //
//                                                                       //
// Copyright (C) 2001-3001 Martin Dougiamas        http://dougiamas.com  //
//           (C) 2001-3001 Eloy Lafuente (stronk7) http://contiento.com  //
//                                                                       //
// This program is free software; you can redistribute it and/or modify  //
// it under the terms of the GNU General Public License as published by  //
// the Free Software Foundation; either version 2 of the License, or     //
// (at your option) any later version.                                   //
//                                                                       //
// This program is distributed in the hope that it will be useful,       //
// but WITHOUT ANY WARRANTY; without even the implied warranty of        //
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the         //
// GNU General Public License for more details:                          //
//                                                                       //
//          https://www.gnu.org/licenses/gpl-3.0.html                         //
//                                                                       //
///////////////////////////////////////////////////////////////////////////

/// This class generate SQL code to be used against MSSQL
/// when running over ODBC. As DB is the same, this inherits
/// everything from XMLDBmssql

require_once($CFG->libdir . '/xmldb/classes/generators/mssql/mssql.class.php');

class XMLDBodbc_mssql extends XMLDBmssql {

    /**
     * Creates one new XMLDBmssql
     */
    function __construct() {
        parent::__construct();
    }
}
