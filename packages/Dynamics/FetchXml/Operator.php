<?php

namespace Packages\Dynamics\FetchXml;

/**
 * @see https://docs.microsoft.com/en-us/power-apps/developer/data-platform/fetchxml-schema
 * @see https://msdynamicscrmblog.wordpress.com/2013/05/10/fetch-xml-and-conditionexpression-operators-using-c-in-dynamics-crm-2011/
 */

class Operator
{

    public const EQ = "eq"; // ==
    public const NE = "ne"; // !=
    public const GT = "gt"; //
    public const GREATER_OR_EQUAL_THAN = "ge";
    public const LESS_THAN = "le";
    public const LESS_OR_EQUAL_THAN = "lt";
    public const LIKE = "like";
    public const NOT_LIKE = "not-like";
    public const IN = "in";
    public const NOT_IN = "not-in";
    public const BETWEEN = "between";
    public const NOT_BETWEEN = "not-between";
    public const ISNULL = "null";
    public const NOTNULL = "not-null";
    public const YESTERDAY = "yesterday";
    public const TODAY = "today";
    public const TOMORROW = "tomorrow";
    public const LAST_7_DAYS = "last-seven-days";
    public const NEXT_7_DAYS = "next-seven-days";
    public const LAST_WEEK = "last-week";
    public const THIS_WEEK = "this-week";
    public const NEXT_WEEK = "next-week";
    public const LAST_MONTH = "last-month";
    public const THIS_MONTH = "this-month";
    public const NEXT_MONTH = "next-month";
    // public const  = "on";
    // public const  = "on-or-before";
    // public const  = "on-or-after";
    public const LAST_YEAR = "last-year";
    public const THIS_YEAR = "this-year";
    public const NEXT_YEAR = "next-year";
    // public const  = "last-x-hours";
    // public const  = "next-x-hours";
    // public const  = "last-x-days";
    // public const  = "next-x-days";
    // public const  = "last-x-weeks";
    // public const  = "next-x-weeks";
    // public const  = "last-x-months";
    // public const  = "next-x-months";
    // public const  = "olderthan-x-months";
    // public const  = "olderthan-x-years";
    // public const  = "olderthan-x-weeks";
    // public const  = "olderthan-x-days";
    // public const  = "olderthan-x-hours";
    // public const  = "olderthan-x-minutes";
    // public const  = "last-x-years";
    // public const  = "next-x-years";
    // public const  = "eq-userid";
    // public const  = "ne-userid";
    // public const  = "eq-userteams";
    // public const  = "eq-useroruserteams";
    // public const  = "eq-useroruserhierarchy";
    // public const  = "eq-useroruserhierarchyandteams";
    // public const  = "eq-businessid";
    // public const  = "ne-businessid";
    // public const  = "eq-userlanguage";
    // public const  = "this-fiscal-year";
    // public const  = "this-fiscal-period";
    // public const  = "next-fiscal-year";
    // public const  = "next-fiscal-period";
    // public const  = "last-fiscal-year";
    // public const  = "last-fiscal-period";
    // public const  = "last-x-fiscal-years";
    // public const  = "last-x-fiscal-periods";
    // public const  = "next-x-fiscal-years";
    // public const  = "next-x-fiscal-periods";
    // public const  = "in-fiscal-year";
    // public const  = "in-fiscal-period";
    // public const  = "in-fiscal-period-and-year";
    // public const  = "in-or-before-fiscal-period-and-year";
    // public const  = "in-or-after-fiscal-period-and-year";
    public const BEGINS_WITH = "begins-with";
    public const NOT_BEGINS_WITH = "not-begin-with";
    public const ENDS_WITH = "ends-with";
    public const NOT_ENDS_WITH = "not-end-with";
    // public const  = "under;
    // public const  = "eq-or-under";
    // public const  = "not-under;
    // public const  = "above";
    // public const  = "eq-or-above";
    // public const  = "contain-values";
    // public const  = "not-contain-values";




}
