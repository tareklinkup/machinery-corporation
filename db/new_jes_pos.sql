-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2017 at 05:26 PM
-- Server version: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `new_jes_pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('4c4ce6f37799851b0a58f264d5bae887', '::1', 'Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36', 1496762637, 'a:7:{s:9:"user_data";s:0:"";s:8:"BRANCHid";s:1:"0";s:8:"FullName";s:7:"New Jes";s:5:"Store";s:9:"Warehouse";s:6:"userId";s:1:"1";s:9:"User_Name";s:6:"newjes";s:11:"accountType";s:5:"Admin";}');

-- --------------------------------------------------------

--
-- Table structure for table `sr_account`
--

CREATE TABLE IF NOT EXISTS `sr_account` (
`Acc_SlNo` int(11) NOT NULL,
  `Acc_Code` varchar(50) NOT NULL,
  `Acc_Name` varchar(200) NOT NULL,
  `Acc_Type` varchar(50) NOT NULL,
  `Acc_Description` varchar(255) NOT NULL,
  `Status` char(1) NOT NULL,
  `AddBy` varchar(50) DEFAULT NULL,
  `AddTime` datetime DEFAULT NULL,
  `UpdateBy` varchar(50) DEFAULT NULL,
  `UpdateTime` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sr_account`
--

INSERT INTO `sr_account` (`Acc_SlNo`, `Acc_Code`, `Acc_Name`, `Acc_Type`, `Acc_Description`, `Status`, `AddBy`, `AddTime`, `UpdateBy`, `UpdateTime`) VALUES
(1, 'A1001', '01712314259', 'Official', 'Test', '', 'New Jes', '2017-06-01 01:13:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sr_cashregister`
--

CREATE TABLE IF NOT EXISTS `sr_cashregister` (
`Transaction_ID` int(11) NOT NULL,
  `Transaction_Date` varchar(20) NOT NULL,
  `IdentityNo` varchar(50) DEFAULT NULL,
  `Narration` varchar(100) NOT NULL,
  `InAmount` varchar(20) NOT NULL,
  `OutAmount` varchar(20) NOT NULL,
  `Description` longtext NOT NULL,
  `Status` char(1) DEFAULT NULL,
  `Saved_By` varchar(50) DEFAULT NULL,
  `Saved_Time` datetime DEFAULT NULL,
  `Edited_By` varchar(50) DEFAULT NULL,
  `Edited_Time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sr_cashtransaction`
--

CREATE TABLE IF NOT EXISTS `sr_cashtransaction` (
`Tr_SlNo` int(11) NOT NULL,
  `Tr_Id` varchar(50) NOT NULL,
  `Tr_date` date NOT NULL,
  `Tr_Type` varchar(20) NOT NULL,
  `Tr_account_Type` varchar(50) NOT NULL,
  `Supplier_SlID` int(11) NOT NULL,
  `Customer_SlID` int(11) NOT NULL,
  `Acc_SlID` int(11) NOT NULL,
  `Acc_Code` varchar(50) DEFAULT NULL,
  `Tr_Description` varchar(255) NOT NULL,
  `In_Amount` varchar(20) NOT NULL,
  `Out_Amount` varchar(20) NOT NULL,
  `Status` char(1) NOT NULL,
  `AddBy` varchar(100) NOT NULL,
  `AddTime` datetime DEFAULT NULL,
  `UpdateBy` varchar(50) DEFAULT NULL,
  `UpdateTime` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sr_cashtransaction`
--

INSERT INTO `sr_cashtransaction` (`Tr_SlNo`, `Tr_Id`, `Tr_date`, `Tr_Type`, `Tr_account_Type`, `Supplier_SlID`, `Customer_SlID`, `Acc_SlID`, `Acc_Code`, `Tr_Description`, `In_Amount`, `Out_Amount`, `Status`, `AddBy`, `AddTime`, `UpdateBy`, `UpdateTime`) VALUES
(1, 'T1001', '2017-06-01', 'Deposit To Bank', 'Official', 0, 0, 1, NULL, 'Test', '50000', '0', '', 'New Jes', '2017-06-01 01:13:25', NULL, NULL),
(2, 'T1002', '2017-06-03', 'Withdraw Form Bank', 'Official', 0, 0, 1, NULL, 'Test ', '0', '50000', '', 'New Jes', '2017-06-03 09:59:22', NULL, NULL),
(3, 'T1003', '2017-06-03', 'Withdraw Form Bank', 'Official', 0, 0, 1, NULL, 'fdfdf', '0', '15000', '', 'New Jes', '2017-06-03 10:05:44', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sr_challandetails`
--

CREATE TABLE IF NOT EXISTS `sr_challandetails` (
`ChallanDetails_SlNo` int(11) NOT NULL,
  `ChallanMaster_SlNo` int(11) NOT NULL,
  `Product_IDNo` int(11) NOT NULL,
  `TotalQuantity` varchar(20) NOT NULL,
  `Purchase_Rate` varchar(19) DEFAULT NULL,
  `ChallanDetails_Rate` varchar(19) NOT NULL,
  `ChallanDetails_unit` varchar(20) NOT NULL,
  `ChallanDetails_Discount` varchar(19) NOT NULL,
  `ChallanDetails_Tax` varchar(19) NOT NULL,
  `ChallanDetails_Freight` varchar(19) NOT NULL,
  `ChallanDetails_TotalAmount` varchar(19) NOT NULL,
  `Status` char(1) NOT NULL,
  `AddBy` varchar(50) DEFAULT NULL,
  `AddTime` datetime DEFAULT NULL,
  `UpdateBy` varchar(50) DEFAULT NULL,
  `UpdateTime` datetime DEFAULT NULL,
  `packageName` varchar(200) NOT NULL,
  `packSellPrice` varchar(20) NOT NULL,
  `ChallanDetails_qty` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sr_challanmaster`
--

CREATE TABLE IF NOT EXISTS `sr_challanmaster` (
`ChallanMaster_SlNo` int(11) NOT NULL,
  `ChallanMaster_ChallanNo` varchar(50) NOT NULL,
  `Po_No` varchar(20) NOT NULL,
  `Delevary_Invoice_No` varchar(20) NOT NULL,
  `Customer_IDNo` int(11) DEFAULT NULL,
  `ChallanDate` date NOT NULL,
  `Description` longtext,
  `ChallanType` varchar(50) NOT NULL,
  `TotalChallanAmount` varchar(20) NOT NULL,
  `TotalDiscountAmount` varchar(20) NOT NULL,
  `TaxAmount` varchar(20) NOT NULL,
  `Freight` varchar(20) NOT NULL,
  `SubTotalAmount` varchar(20) NOT NULL,
  `PaidAmount` varchar(20) NOT NULL,
  `paidby` varchar(30) NOT NULL,
  `DueAmount` varchar(20) NOT NULL,
  `TotalDue` varchar(20) NOT NULL DEFAULT '0.00',
  `Status` char(1) NOT NULL,
  `AddBy` varchar(50) DEFAULT NULL,
  `AddTime` datetime DEFAULT NULL,
  `UpdateBy` varchar(50) DEFAULT NULL,
  `UpdateTime` datetime DEFAULT NULL,
  `ChallanMaster_branchid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sr_company`
--

CREATE TABLE IF NOT EXISTS `sr_company` (
`Company_SlNo` int(11) NOT NULL,
  `Company_Name` varchar(150) NOT NULL,
  `Repot_Heading` text NOT NULL,
  `Company_Logo_org` varchar(250) NOT NULL,
  `Company_Logo_thum` varchar(250) NOT NULL,
  `Invoice_Type` int(11) NOT NULL,
  `Currency_Name` varchar(50) DEFAULT NULL,
  `Currency_Symbol` varchar(10) DEFAULT NULL,
  `SubCurrency_Name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sr_country`
--

CREATE TABLE IF NOT EXISTS `sr_country` (
`Country_SlNo` int(11) NOT NULL,
  `CountryName` varchar(50) NOT NULL,
  `Status` char(1) NOT NULL,
  `AddBy` varchar(50) DEFAULT NULL,
  `AddTime` datetime DEFAULT NULL,
  `UpdateBy` varchar(50) DEFAULT NULL,
  `UpdateTime` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sr_country`
--

INSERT INTO `sr_country` (`Country_SlNo`, `CountryName`, `Status`, `AddBy`, `AddTime`, `UpdateBy`, `UpdateTime`) VALUES
(1, 'Bangladesh', '', 'New Jes', '2017-05-07 04:00:21', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sr_currentinventory`
--

CREATE TABLE IF NOT EXISTS `sr_currentinventory` (
`CurrentInventory_SlNo` int(11) NOT NULL,
  `Product_SlNo` int(11) NOT NULL,
  `CurrentInventory_CurrentQuantity` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sr_customer`
--

CREATE TABLE IF NOT EXISTS `sr_customer` (
`Customer_SlNo` int(11) NOT NULL,
  `Customer_Code` varchar(50) NOT NULL,
  `Customer_Name` varchar(150) NOT NULL,
  `Customer_Type` varchar(50) NOT NULL,
  `Customer_Phone` varchar(50) NOT NULL,
  `Customer_Mobile` varchar(150) NOT NULL DEFAULT '0',
  `Customer_Email` varchar(100) NOT NULL,
  `Customer_OfficePhone` varchar(50) NOT NULL,
  `Customer_Address` text NOT NULL,
  `Country_SlNo` int(11) NOT NULL DEFAULT '1',
  `Customer_Web` varchar(50) NOT NULL,
  `Customer_Credit_Limit` varchar(20) NOT NULL,
  `Status` char(1) NOT NULL DEFAULT 'c',
  `AddBy` varchar(50) DEFAULT NULL,
  `AddTime` datetime DEFAULT NULL,
  `UpdateBy` varchar(50) DEFAULT NULL,
  `UpdateTime` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sr_customer`
--

INSERT INTO `sr_customer` (`Customer_SlNo`, `Customer_Code`, `Customer_Name`, `Customer_Type`, `Customer_Phone`, `Customer_Mobile`, `Customer_Email`, `Customer_OfficePhone`, `Customer_Address`, `Country_SlNo`, `Customer_Web`, `Customer_Credit_Limit`, `Status`, `AddBy`, `AddTime`, `UpdateBy`, `UpdateTime`) VALUES
(1, 'C1001', 'Customer 1', 'Local', '01712314259', '01712314259', 'customer1@gmail.com', '', 'Dhaka', 1, '', '10000000', 'c', 'New Jes', '2017-05-07 04:01:54', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sr_customer_payment`
--

CREATE TABLE IF NOT EXISTS `sr_customer_payment` (
`CPayment_id` int(11) NOT NULL,
  `CPayment_date` date NOT NULL,
  `CPayment_invoice` varchar(20) CHARACTER SET latin1 NOT NULL,
  `CPayment_customerID` varchar(20) CHARACTER SET latin1 NOT NULL,
  `CPayment_amount` varchar(20) CHARACTER SET latin1 NOT NULL,
  `CPayment_Paymentby` varchar(50) NOT NULL,
  `CPayment_notes` varchar(225) CHARACTER SET latin1 NOT NULL,
  `CPayment_Addby` varchar(100) CHARACTER SET latin1 NOT NULL,
  `CPayment_AddTime` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sr_customer_payment`
--

INSERT INTO `sr_customer_payment` (`CPayment_id`, `CPayment_date`, `CPayment_invoice`, `CPayment_customerID`, `CPayment_amount`, `CPayment_Paymentby`, `CPayment_notes`, `CPayment_Addby`, `CPayment_AddTime`) VALUES
(1, '2017-05-11', '2017-05-11-01', '1', '1100', '', 'Test Warehouse Sales', 'New Jes', '0000-00-00 00:00:00'),
(2, '2017-05-11', '2017-05-11-02', '1', '2200', '', 'Warehouse Sales', 'New Jes', '0000-00-00 00:00:00'),
(3, '2017-06-01', '2017-06-01-03', '1', '1200', '', '', 'New Jes', '0000-00-00 00:00:00'),
(4, '2017-06-01', '2017-06-01-04', '1', '1000', '', '', 'New Jes', '0000-00-00 00:00:00'),
(5, '2017-06-01', '2017-05-11-01', '1', '2500', '', '0', 'New Jes', '0000-00-00 00:00:00'),
(6, '2017-06-04', '2017-06-04-05', '0', '120', '', '', 'New Jes', '0000-00-00 00:00:00'),
(7, '2017-06-04', '2017-06-04-06', '0', '1100', '', '', 'New Jes', '0000-00-00 00:00:00'),
(8, '2017-06-04', '2017-06-04-07', '0', '2200', '', 'Test Warehouse Customer Sales', 'New Jes', '0000-00-00 00:00:00'),
(9, '2017-06-04', '2017-06-04-08', '0', '500', '', '', 'New Jes', '0000-00-00 00:00:00'),
(10, '2017-06-04', '2017-06-04-09', '0', '1200', '', '', 'New Jes', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sr_damage`
--

CREATE TABLE IF NOT EXISTS `sr_damage` (
`Damage_SlNo` int(11) NOT NULL,
  `Damage_InvoiceNo` varchar(50) NOT NULL,
  `Damage_Date` date NOT NULL,
  `Damage_Description` varchar(300) NOT NULL,
  `Status` char(1) NOT NULL,
  `AddBy` varchar(50) DEFAULT NULL,
  `AddTime` datetime DEFAULT NULL,
  `UpdateBy` varchar(50) DEFAULT NULL,
  `UpdateTime` datetime DEFAULT NULL,
  `Damage_brunchid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sr_damagedetails`
--

CREATE TABLE IF NOT EXISTS `sr_damagedetails` (
`DamageDetails_SlNo` int(11) NOT NULL,
  `Damage_SlNo` int(11) NOT NULL,
  `Product_SlNo` int(11) NOT NULL,
  `DamageDetails_DamageQuantity` varchar(20) NOT NULL,
  `Status` char(1) NOT NULL,
  `AddBy` varchar(50) DEFAULT NULL,
  `AddTime` datetime DEFAULT NULL,
  `UpdateBy` varchar(50) DEFAULT NULL,
  `UpdateTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sr_department`
--

CREATE TABLE IF NOT EXISTS `sr_department` (
`Department_SlNo` int(11) NOT NULL,
  `Department_Name` varchar(50) NOT NULL,
  `Status` char(1) NOT NULL,
  `AddBy` varchar(50) DEFAULT NULL,
  `AddTime` datetime DEFAULT NULL,
  `UpdateBy` varchar(50) DEFAULT NULL,
  `UpdateTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sr_designation`
--

CREATE TABLE IF NOT EXISTS `sr_designation` (
`Designation_SlNo` int(11) NOT NULL,
  `Designation_Name` varchar(50) NOT NULL,
  `Status` char(1) NOT NULL,
  `AddBy` varchar(50) DEFAULT NULL,
  `AddTime` datetime DEFAULT NULL,
  `UpdateBy` varchar(50) DEFAULT NULL,
  `UpdateTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sr_district`
--

CREATE TABLE IF NOT EXISTS `sr_district` (
`District_SlNo` int(11) NOT NULL,
  `District_Name` varchar(50) NOT NULL,
  `Status` char(10) NOT NULL,
  `AddBy` varchar(50) DEFAULT NULL,
  `AddTime` datetime DEFAULT NULL,
  `UpdateBy` varchar(50) DEFAULT NULL,
  `UpdateTime` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sr_district`
--

INSERT INTO `sr_district` (`District_SlNo`, `District_Name`, `Status`, `AddBy`, `AddTime`, `UpdateBy`, `UpdateTime`) VALUES
(1, 'Dhaka', '', 'New Jes', '2017-05-07 03:58:56', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sr_employee`
--

CREATE TABLE IF NOT EXISTS `sr_employee` (
`Employee_SlNo` int(11) NOT NULL,
  `Designation_ID` int(11) NOT NULL,
  `Department_ID` int(11) NOT NULL,
  `Employee_ID` varchar(50) NOT NULL,
  `Employee_Name` varchar(150) NOT NULL,
  `Employee_JoinDate` date NOT NULL,
  `Employee_Gender` varchar(20) NOT NULL,
  `Employee_BirthDate` date NOT NULL,
  `Employee_NID` varchar(50) NOT NULL,
  `Employee_ContactNo` varchar(20) NOT NULL,
  `Employee_Email` varchar(50) NOT NULL,
  `Employee_MaritalStatus` varchar(50) NOT NULL,
  `Employee_FatherName` varchar(150) NOT NULL,
  `Employee_MotherName` varchar(150) NOT NULL,
  `Employee_PrasentAddress` text NOT NULL,
  `Employee_PermanentAddress` text NOT NULL,
  `Employee_Pic_org` varchar(250) NOT NULL,
  `Employee_Pic_thum` varchar(250) NOT NULL,
  `Status` varchar(1) NOT NULL,
  `AddBy` varchar(50) NOT NULL,
  `AddTime` varchar(50) NOT NULL,
  `UpdateBy` varchar(50) NOT NULL,
  `UpdateTime` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sr_package`
--

CREATE TABLE IF NOT EXISTS `sr_package` (
`package_ID` int(11) NOT NULL,
  `package_name` varchar(250) CHARACTER SET latin1 NOT NULL,
  `package_categoryid` int(11) NOT NULL,
  `package_purchPrice` varchar(20) CHARACTER SET latin1 NOT NULL,
  `package_sellPrice` varchar(20) CHARACTER SET latin1 NOT NULL,
  `package_ProCode` varchar(20) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sr_package_create`
--

CREATE TABLE IF NOT EXISTS `sr_package_create` (
`create_ID` int(11) NOT NULL,
  `create_pacageID` varchar(20) CHARACTER SET latin1 NOT NULL,
  `create_item` varchar(250) NOT NULL,
  `create_purch_price` varchar(20) CHARACTER SET latin1 NOT NULL,
  `create_sell_price` varchar(20) CHARACTER SET latin1 NOT NULL,
  `cteate_qty` varchar(20) NOT NULL,
  `create_proCode` varchar(20) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sr_productcategory`
--

CREATE TABLE IF NOT EXISTS `sr_productcategory` (
`ProductCategory_SlNo` int(11) NOT NULL,
  `ProductCategory_Name` varchar(150) NOT NULL,
  `ProductCategory_Description` varchar(300) NOT NULL,
  `Status` char(1) NOT NULL,
  `AddBy` varchar(50) NOT NULL,
  `AddTime` varchar(30) NOT NULL,
  `UpdateBy` varchar(50) NOT NULL,
  `UpdateTime` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sr_productcategory`
--

INSERT INTO `sr_productcategory` (`ProductCategory_SlNo`, `ProductCategory_Name`, `ProductCategory_Description`, `Status`, `AddBy`, `AddTime`, `UpdateBy`, `UpdateTime`) VALUES
(1, 'Category 1', 'Category 1 Details', '', 'New Jes', '2017-05-07 04:02:58', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `sr_purchasedetails`
--

CREATE TABLE IF NOT EXISTS `sr_purchasedetails` (
`PurchaseDetails_SlNo` int(11) NOT NULL,
  `PurchaseMaster_IDNo` int(11) NOT NULL,
  `Product_IDNo` int(11) NOT NULL,
  `PurchaseDetails_TotalQuantity` varchar(20) NOT NULL,
  `PurchaseDetail_ReceiveQuantity` varchar(20) NOT NULL,
  `PurchaseDetails_Rate` varchar(20) NOT NULL,
  `PurchaseDetails_Unit` varchar(20) NOT NULL,
  `PurchaseDetails_ExpireDate` datetime NOT NULL,
  `PurchaseDetails_Discount` varchar(20) NOT NULL,
  `PurchaseDetails_Tax` varchar(20) NOT NULL,
  `PurchaseDetails_Freight` varchar(20) NOT NULL,
  `PurchaseDetails_TotalAmount` varchar(20) NOT NULL,
  `Status` char(1) NOT NULL,
  `AddBy` varchar(50) DEFAULT NULL,
  `AddTime` datetime DEFAULT NULL,
  `UpdateBy` varchar(50) DEFAULT NULL,
  `UpdateTime` datetime DEFAULT NULL,
  `PurchaseDetails_branchID` int(11) NOT NULL,
  `PackName` varchar(200) NOT NULL,
  `PackPice` varchar(20) NOT NULL,
  `Pack_qty` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sr_purchasedetails`
--

INSERT INTO `sr_purchasedetails` (`PurchaseDetails_SlNo`, `PurchaseMaster_IDNo`, `Product_IDNo`, `PurchaseDetails_TotalQuantity`, `PurchaseDetail_ReceiveQuantity`, `PurchaseDetails_Rate`, `PurchaseDetails_Unit`, `PurchaseDetails_ExpireDate`, `PurchaseDetails_Discount`, `PurchaseDetails_Tax`, `PurchaseDetails_Freight`, `PurchaseDetails_TotalAmount`, `Status`, `AddBy`, `AddTime`, `UpdateBy`, `UpdateTime`, `PurchaseDetails_branchID`, `PackName`, `PackPice`, `Pack_qty`) VALUES
(1, 1, 3, '10', '', '30', 'PCS', '0000-00-00 00:00:00', '', '', '', '', '', NULL, NULL, NULL, NULL, 0, '', '', ''),
(2, 1, 2, '10', '', '50', 'PCS', '0000-00-00 00:00:00', '', '', '', '', '', NULL, NULL, NULL, NULL, 0, '', '', ''),
(3, 1, 1, '10', '', '100', 'PCS', '0000-00-00 00:00:00', '', '', '', '', '', NULL, NULL, NULL, NULL, 0, '', '', ''),
(4, 2, 1, '20', '', '100', 'PCS', '0000-00-00 00:00:00', '', '', '', '', '', NULL, NULL, NULL, NULL, 0, '', '', ''),
(5, 2, 3, '20', '', '30', 'PCS', '0000-00-00 00:00:00', '', '', '', '', '', NULL, NULL, NULL, NULL, 0, '', '', ''),
(6, 2, 2, '20', '', '50', 'PCS', '0000-00-00 00:00:00', '', '', '', '', '', NULL, NULL, NULL, NULL, 0, '', '', ''),
(7, 3, 1, '30', '', '100', 'PCS', '0000-00-00 00:00:00', '', '', '', '', '', NULL, NULL, NULL, NULL, 0, '', '', ''),
(8, 3, 3, '30', '', '30', 'PCS', '0000-00-00 00:00:00', '', '', '', '', '', NULL, NULL, NULL, NULL, 0, '', '', ''),
(9, 3, 2, '30', '', '50', 'PCS', '0000-00-00 00:00:00', '', '', '', '', '', NULL, NULL, NULL, NULL, 0, '', '', ''),
(10, 4, 1, '20', '', '100', 'PCS', '0000-00-00 00:00:00', '', '', '', '', '', NULL, NULL, NULL, NULL, 0, '', '', ''),
(11, 4, 2, '20', '', '50', 'PCS', '0000-00-00 00:00:00', '', '', '', '', '', NULL, NULL, NULL, NULL, 0, '', '', ''),
(12, 4, 3, '20', '', '30', 'PCS', '0000-00-00 00:00:00', '', '', '', '', '', NULL, NULL, NULL, NULL, 0, '', '', ''),
(13, 5, 1, '20', '', '100', 'PCS', '0000-00-00 00:00:00', '', '', '', '', '', NULL, NULL, NULL, NULL, 0, '', '', ''),
(14, 5, 3, '20', '', '30', 'PCS', '0000-00-00 00:00:00', '', '', '', '', '', NULL, NULL, NULL, NULL, 0, '', '', ''),
(15, 6, 2, '20', '', '50', 'PCS', '0000-00-00 00:00:00', '', '', '', '', '', NULL, NULL, NULL, NULL, 0, '', '', ''),
(16, 7, 1, '10', '', '100', 'PCS', '0000-00-00 00:00:00', '', '', '', '', '', NULL, NULL, NULL, NULL, 0, '', '', ''),
(17, 8, 1, '50', '', '100', 'PCS', '0000-00-00 00:00:00', '', '', '', '', '', NULL, NULL, NULL, NULL, 0, '', '', ''),
(18, 8, 2, '50', '', '50', 'PCS', '0000-00-00 00:00:00', '', '', '', '', '', NULL, NULL, NULL, NULL, 0, '', '', ''),
(19, 8, 3, '100', '', '30', 'PCS', '0000-00-00 00:00:00', '', '', '', '', '', NULL, NULL, NULL, NULL, 0, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `sr_purchaseinventory`
--

CREATE TABLE IF NOT EXISTS `sr_purchaseinventory` (
`PurchaseInventory_SlNo` int(11) NOT NULL,
  `purchProduct_IDNo` int(11) NOT NULL,
  `PurchaseInventory_Store` varchar(20) NOT NULL,
  `PurchaseInventory_TotalQuantity` double NOT NULL,
  `PurchaseInventory_ReceiveQuantity` double NOT NULL,
  `PurchaseInventory_ReturnQuantity` double NOT NULL,
  `PurchaseInventory_DamageQuantity` double NOT NULL,
  `AddBy` varchar(50) DEFAULT NULL,
  `AddTime` datetime DEFAULT NULL,
  `UpdateBy` varchar(50) DEFAULT NULL,
  `UpdateTime` datetime DEFAULT NULL,
  `PurchaseInventory_packqty` varchar(20) NOT NULL,
  `PurchaseInventory_packname` varchar(200) NOT NULL,
  `PurchaseInventory_returnqty` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sr_purchaseinventory`
--

INSERT INTO `sr_purchaseinventory` (`PurchaseInventory_SlNo`, `purchProduct_IDNo`, `PurchaseInventory_Store`, `PurchaseInventory_TotalQuantity`, `PurchaseInventory_ReceiveQuantity`, `PurchaseInventory_ReturnQuantity`, `PurchaseInventory_DamageQuantity`, `AddBy`, `AddTime`, `UpdateBy`, `UpdateTime`, `PurchaseInventory_packqty`, `PurchaseInventory_packname`, `PurchaseInventory_returnqty`) VALUES
(1, 3, 'Warehouse', 50, 0, 0, 0, NULL, NULL, NULL, NULL, '', '', ''),
(2, 2, 'Warehouse', 50, 0, 0, 0, NULL, NULL, NULL, NULL, '', '', ''),
(3, 1, 'Warehouse', 95, 0, 0, 0, NULL, NULL, NULL, NULL, '', '', ''),
(4, 1, 'Shop', 110, 0, 0, 0, NULL, NULL, NULL, NULL, '', '', ''),
(5, 3, 'Shop', 150, 0, 0, 0, NULL, NULL, NULL, NULL, '', '', ''),
(6, 2, 'Shop', 100, 0, 0, 0, NULL, NULL, NULL, NULL, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `sr_purchasemaster`
--

CREATE TABLE IF NOT EXISTS `sr_purchasemaster` (
`PurchaseMaster_SlNo` int(11) NOT NULL,
  `Supplier_SlNo` int(11) NOT NULL,
  `Employee_SlNo` int(11) NOT NULL,
  `PurchaseMaster_InvoiceNo` varchar(50) NOT NULL,
  `PurchaseMaster_OrderDate` date NOT NULL,
  `PurchaseMaster_PurchaseFor` varchar(20) NOT NULL,
  `PurchaseMaster_Description` longtext NOT NULL,
  `PurchaseMaster_PurchaseType` varchar(50) NOT NULL,
  `PurchaseMaster_TotalAmount` varchar(20) NOT NULL,
  `PurchaseMaster_DiscountAmount` varchar(20) NOT NULL,
  `PurchaseMaster_Tax` varchar(20) NOT NULL,
  `PurchaseMaster_Freight` varchar(20) NOT NULL,
  `PurchaseMaster_SubTotalAmount` varchar(20) NOT NULL,
  `PurchaseMaster_PaidAmount` varchar(20) NOT NULL,
  `PurchaseMaster_DueAmount` varchar(20) NOT NULL,
  `PurchaseMaster_ReceiveDate` datetime NOT NULL,
  `PurchaseMaster_Status` char(1) NOT NULL DEFAULT 'A',
  `Status` char(1) NOT NULL,
  `AddBy` varchar(50) DEFAULT NULL,
  `AddTime` datetime DEFAULT NULL,
  `UpdateBy` varchar(50) DEFAULT NULL,
  `UpdateTime` datetime DEFAULT NULL,
  `PurchaseMaster_GUID` varchar(64) NOT NULL,
  `PurchaseMaster_BranchID` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sr_purchasemaster`
--

INSERT INTO `sr_purchasemaster` (`PurchaseMaster_SlNo`, `Supplier_SlNo`, `Employee_SlNo`, `PurchaseMaster_InvoiceNo`, `PurchaseMaster_OrderDate`, `PurchaseMaster_PurchaseFor`, `PurchaseMaster_Description`, `PurchaseMaster_PurchaseType`, `PurchaseMaster_TotalAmount`, `PurchaseMaster_DiscountAmount`, `PurchaseMaster_Tax`, `PurchaseMaster_Freight`, `PurchaseMaster_SubTotalAmount`, `PurchaseMaster_PaidAmount`, `PurchaseMaster_DueAmount`, `PurchaseMaster_ReceiveDate`, `PurchaseMaster_Status`, `Status`, `AddBy`, `AddTime`, `UpdateBy`, `UpdateTime`, `PurchaseMaster_GUID`, `PurchaseMaster_BranchID`) VALUES
(1, 1, 0, '2017-05-09-01', '2017-05-09', 'Warehouse', 'Test', '', '1800', '0', '0', '0', '1800', '800', '1000', '0000-00-00 00:00:00', 'A', '', 'New Jes', '2017-05-09 11:40:15', NULL, NULL, '', 0),
(2, 1, 0, '2017-05-09-02', '2017-05-09', 'Warehouse', '', '', '3600', '0', '0', '0', '3600', '3600', '0', '0000-00-00 00:00:00', 'A', '', 'New Jes', '2017-05-09 11:42:06', NULL, NULL, '', 0),
(3, 1, 0, '2017-05-09-03', '2017-05-09', 'Shop', '', '', '5400', '0', '0', '0', '5400', '5400', '0', '0000-00-00 00:00:00', 'A', '', 'New Jes', '2017-05-09 11:42:53', NULL, NULL, '', 0),
(4, 1, 0, '2017-05-09-04', '2017-05-09', 'Shop', '', '', '3600', '0', '0', '0', '3600', '1500', '2100', '0000-00-00 00:00:00', 'A', '', 'New Jes', '2017-05-09 11:43:40', NULL, NULL, '', 0),
(5, 1, 0, '2017-05-09-05', '2017-05-09', 'Warehouse', '', '', '2600', '0', '0', '0', '2600', '2600', '0', '0000-00-00 00:00:00', 'A', '', 'New Jes', '2017-05-09 11:44:36', NULL, NULL, '', 0),
(6, 1, 0, '2017-05-09-06', '2017-05-09', 'Warehouse', '', '', '1000', '0', '0', '0', '1000', '1000', '0', '0000-00-00 00:00:00', 'A', '', 'New Jes', '2017-05-09 11:44:57', NULL, NULL, '', 0),
(7, 1, 0, '2017-06-04-07', '2017-06-04', 'Shop', '', '', '1000', '0', '0', '0', '1000', '1000', '0', '0000-00-00 00:00:00', 'A', '', 'New Jes', '2017-06-04 05:55:51', NULL, NULL, '', 0),
(8, 1, 0, '2017-06-04-08', '2017-06-04', 'Shop', 'Test', '', '10500', '200', '0', '100', '10400', '8400', '2000', '0000-00-00 00:00:00', 'A', '', 'New Jes', '2017-06-04 05:57:52', NULL, NULL, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sr_purchasereturn`
--

CREATE TABLE IF NOT EXISTS `sr_purchasereturn` (
`PurchaseReturn_SlNo` int(11) NOT NULL,
  `PurchaseMaster_InvoiceNo` varchar(50) NOT NULL,
  `Supplier_IDdNo` int(11) NOT NULL,
  `PurchaseReturn_ReturnDate` date NOT NULL,
  `PurchaseReturn_ReturnQuantity` varchar(20) NOT NULL,
  `PurchaseReturn_ReturnAmount` varchar(20) NOT NULL,
  `PurchaseReturn_Description` varchar(300) NOT NULL,
  `Status` char(1) NOT NULL,
  `AddBy` varchar(50) DEFAULT NULL,
  `AddTime` datetime DEFAULT NULL,
  `UpdateBy` varchar(50) DEFAULT NULL,
  `UpdateTime` datetime DEFAULT NULL,
  `PurchaseReturn_brunchID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sr_purchasereturndetails`
--

CREATE TABLE IF NOT EXISTS `sr_purchasereturndetails` (
`PurchaseReturnDetails_SlNo` int(11) NOT NULL,
  `PurchaseReturn_SlNo` int(11) NOT NULL,
  `PurchaseReturnDetails_ReturnDate` date NOT NULL,
  `PurchaseReturnDetailsProduct_SlNo` int(11) NOT NULL,
  `PurchaseReturnDetails_ReceiveQuantity` varchar(20) NOT NULL,
  `PurchaseReturnDetails_ReturnQuantity` varchar(20) NOT NULL,
  `PurchaseReturnDetails_ReturnAmount` varchar(19) NOT NULL,
  `Status` char(1) NOT NULL,
  `AddBy` varchar(50) DEFAULT NULL,
  `AddTime` datetime DEFAULT NULL,
  `UpdateBy` varchar(50) DEFAULT NULL,
  `UpdateTime` datetime DEFAULT NULL,
  `PurchaseReturnDetails_brachid` int(11) NOT NULL,
  `PurchaseReturnDetails_pacQty` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sr_saledetails`
--

CREATE TABLE IF NOT EXISTS `sr_saledetails` (
`SaleDetails_SlNo` int(11) NOT NULL,
  `SaleMaster_IDNo` int(11) NOT NULL,
  `Product_IDNo` int(11) NOT NULL,
  `SaleDetails_TotalQuantity` varchar(20) NOT NULL,
  `Purchase_Rate` varchar(19) DEFAULT NULL,
  `SaleDetails_Rate` varchar(19) NOT NULL,
  `SaleDetails_unit` varchar(20) NOT NULL,
  `SaleDetails_Discount` varchar(19) NOT NULL,
  `SaleDetails_Tax` varchar(19) NOT NULL,
  `SaleDetails_Freight` varchar(19) NOT NULL,
  `SaleDetails_TotalAmount` varchar(19) NOT NULL,
  `Status` char(1) NOT NULL,
  `AddBy` varchar(50) DEFAULT NULL,
  `AddTime` datetime DEFAULT NULL,
  `UpdateBy` varchar(50) DEFAULT NULL,
  `UpdateTime` datetime DEFAULT NULL,
  `packageName` varchar(200) NOT NULL,
  `packSellPrice` varchar(20) NOT NULL,
  `SeleDetails_qty` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sr_saledetails`
--

INSERT INTO `sr_saledetails` (`SaleDetails_SlNo`, `SaleMaster_IDNo`, `Product_IDNo`, `SaleDetails_TotalQuantity`, `Purchase_Rate`, `SaleDetails_Rate`, `SaleDetails_unit`, `SaleDetails_Discount`, `SaleDetails_Tax`, `SaleDetails_Freight`, `SaleDetails_TotalAmount`, `Status`, `AddBy`, `AddTime`, `UpdateBy`, `UpdateTime`, `packageName`, `packSellPrice`, `SeleDetails_qty`) VALUES
(1, 1, 3, '5', '30', '40', 'PCS', '', '', '', '', '', NULL, NULL, NULL, NULL, '', '', ''),
(2, 1, 2, '5', '50', '60', 'PCS', '', '', '', '', '', NULL, NULL, NULL, NULL, '', '', ''),
(3, 1, 1, '5', '100', '120', 'PCS', '', '', '', '', '', NULL, NULL, NULL, NULL, '', '', ''),
(4, 2, 2, '10', '50', '60', 'PCS', '', '', '', '', '', NULL, NULL, NULL, NULL, '', '', ''),
(5, 2, 1, '10', '100', '120', 'PCS', '', '', '', '', '', NULL, NULL, NULL, NULL, '', '', ''),
(6, 2, 3, '10', '30', '40', 'PCS', '', '', '', '', '', NULL, NULL, NULL, NULL, '', '', ''),
(7, 3, 1, '10', '100', '120', 'PCS', '', '', '', '', '', NULL, NULL, NULL, NULL, '', '', ''),
(8, 4, 1, '50', '100', '120', 'PCS', '', '', '', '', '', NULL, NULL, NULL, NULL, '', '', ''),
(9, 4, 2, '50', '50', '60', 'PCS', '', '', '', '', '', NULL, NULL, NULL, NULL, '', '', ''),
(10, 5, 1, '1', '100', '120', 'PCS', '', '', '', '', '', NULL, NULL, NULL, NULL, '', '', ''),
(11, 6, 1, '5', '100', '120', 'PCS', '', '', '', '', '', NULL, NULL, NULL, NULL, '', '', ''),
(12, 6, 2, '5', '50', '60', 'PCS', '', '', '', '', '', NULL, NULL, NULL, NULL, '', '', ''),
(13, 6, 3, '5', '30', '40', 'PCS', '', '', '', '', '', NULL, NULL, NULL, NULL, '', '', ''),
(14, 7, 1, '10', '100', '120', 'PCS', '', '', '', '', '', NULL, NULL, NULL, NULL, '', '', ''),
(15, 7, 2, '10', '50', '60', 'PCS', '', '', '', '', '', NULL, NULL, NULL, NULL, '', '', ''),
(16, 7, 3, '10', '30', '40', 'PCS', '', '', '', '', '', NULL, NULL, NULL, NULL, '', '', ''),
(17, 8, 2, '10', '50', '60', 'PCS', '', '', '', '', '', NULL, NULL, NULL, NULL, '', '', ''),
(18, 9, 1, '10', '100', '120', 'PCS', '', '', '', '', '', NULL, NULL, NULL, NULL, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `sr_saleinventory`
--

CREATE TABLE IF NOT EXISTS `sr_saleinventory` (
`SaleInventory_SlNo` int(11) NOT NULL,
  `sellProduct_IdNo` int(11) NOT NULL,
  `SaleInventory_Store` varchar(20) NOT NULL,
  `SaleInventory_TotalQuantity` double NOT NULL,
  `SaleInventory_ReceiveQuantity` double NOT NULL,
  `SaleInventory_ReturnQuantity` double NOT NULL,
  `SaleInventory_DamageQuantity` double NOT NULL,
  `AddBy` varchar(50) DEFAULT NULL,
  `AddTime` datetime DEFAULT NULL,
  `UpdateBy` varchar(50) DEFAULT NULL,
  `UpdateTime` datetime DEFAULT NULL,
  `SaleInventory_packname` varchar(200) NOT NULL,
  `SaleInventory_qty` varchar(20) NOT NULL,
  `SaleInventory_returnqty` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sr_saleinventory`
--

INSERT INTO `sr_saleinventory` (`SaleInventory_SlNo`, `sellProduct_IdNo`, `SaleInventory_Store`, `SaleInventory_TotalQuantity`, `SaleInventory_ReceiveQuantity`, `SaleInventory_ReturnQuantity`, `SaleInventory_DamageQuantity`, `AddBy`, `AddTime`, `UpdateBy`, `UpdateTime`, `SaleInventory_packname`, `SaleInventory_qty`, `SaleInventory_returnqty`) VALUES
(1, 3, 'Warehouse', 25, 0, 0, 0, NULL, NULL, NULL, NULL, '', '', ''),
(2, 2, 'Warehouse', 25, 0, 0, 0, NULL, NULL, NULL, NULL, '', '', ''),
(3, 1, 'Warehouse', 45, 0, 0, 0, NULL, NULL, NULL, NULL, '', '', ''),
(4, 1, 'Shop', 71, 0, 0, 0, NULL, NULL, NULL, NULL, '', '', ''),
(5, 2, 'Shop', 65, 0, 0, 0, NULL, NULL, NULL, NULL, '', '', ''),
(6, 3, 'Shop', 5, 0, 0, 0, NULL, NULL, NULL, NULL, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `sr_salereturn`
--

CREATE TABLE IF NOT EXISTS `sr_salereturn` (
`SaleReturn_SlNo` int(11) NOT NULL,
  `SaleMaster_InvoiceNo` varchar(50) NOT NULL,
  `SaleReturn_ReturnDate` date NOT NULL,
  `SaleReturn_ReturnQuantity` varchar(20) NOT NULL,
  `SaleReturn_ReturnAmount` varchar(20) NOT NULL,
  `SaleReturn_Description` varchar(300) NOT NULL,
  `Status` char(1) NOT NULL,
  `AddBy` varchar(50) DEFAULT NULL,
  `AddTime` datetime DEFAULT NULL,
  `UpdateBy` varchar(50) DEFAULT NULL,
  `UpdateTime` datetime DEFAULT NULL,
  `SaleReturn_brunchId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sr_salereturndetails`
--

CREATE TABLE IF NOT EXISTS `sr_salereturndetails` (
`SaleReturnDetails_SlNo` int(11) NOT NULL,
  `SaleReturn_IdNo` int(11) NOT NULL,
  `SaleReturnDetails_ReturnDate` date NOT NULL,
  `SaleReturnDetailsProduct_SlNo` int(11) NOT NULL,
  `SaleReturnDetails_SaleQuantity` varchar(20) NOT NULL,
  `SaleReturnDetails_ReturnQuantity` varchar(20) NOT NULL,
  `SaleReturnDetails_ReturnAmount` varchar(20) NOT NULL,
  `Status` char(1) NOT NULL,
  `AddBy` varchar(50) DEFAULT NULL,
  `AddTime` datetime DEFAULT NULL,
  `UpdateBy` varchar(50) DEFAULT NULL,
  `UpdateTime` datetime DEFAULT NULL,
  `SaleReturnDetails_brunchID` int(11) NOT NULL,
  `SaleReturnDetails_Qty` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sr_salesmaster`
--

CREATE TABLE IF NOT EXISTS `sr_salesmaster` (
`SaleMaster_SlNo` int(11) NOT NULL,
  `SaleMaster_InvoiceNo` varchar(50) NOT NULL,
  `SalseCustomer_IDNo` int(11) DEFAULT NULL,
  `SalseCustomer_Name` varchar(200) NOT NULL,
  `SalseCustomer_Contact` varchar(50) NOT NULL,
  `SalseCustomer_Address` text NOT NULL,
  `SaleMaster_SaleDate` date NOT NULL,
  `SaleMaster_Description` longtext,
  `SaleMaster_SaleType` varchar(50) NOT NULL,
  `SaleMaster_TotalSaleAmount` varchar(20) NOT NULL,
  `SaleMaster_TotalDiscountAmount` varchar(20) NOT NULL,
  `SaleMaster_TaxAmount` varchar(20) NOT NULL,
  `SaleMaster_Freight` varchar(20) NOT NULL,
  `SaleMaster_SubTotalAmount` varchar(20) NOT NULL,
  `SaleMaster_PaidAmount` varchar(20) NOT NULL,
  `SaleMaster_paidby` varchar(30) NOT NULL,
  `SaleMaster_DueAmount` varchar(20) NOT NULL,
  `SaleMaster_Dalivery_Status` char(1) NOT NULL DEFAULT 'D',
  `Status` char(1) NOT NULL DEFAULT 'A',
  `AddBy` varchar(50) DEFAULT NULL,
  `AddTime` datetime DEFAULT NULL,
  `UpdateBy` varchar(50) DEFAULT NULL,
  `UpdateTime` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sr_salesmaster`
--

INSERT INTO `sr_salesmaster` (`SaleMaster_SlNo`, `SaleMaster_InvoiceNo`, `SalseCustomer_IDNo`, `SalseCustomer_Name`, `SalseCustomer_Contact`, `SalseCustomer_Address`, `SaleMaster_SaleDate`, `SaleMaster_Description`, `SaleMaster_SaleType`, `SaleMaster_TotalSaleAmount`, `SaleMaster_TotalDiscountAmount`, `SaleMaster_TaxAmount`, `SaleMaster_Freight`, `SaleMaster_SubTotalAmount`, `SaleMaster_PaidAmount`, `SaleMaster_paidby`, `SaleMaster_DueAmount`, `SaleMaster_Dalivery_Status`, `Status`, `AddBy`, `AddTime`, `UpdateBy`, `UpdateTime`) VALUES
(1, '2017-05-11-01', 1, '', '', '', '2017-05-11', 'Test Warehouse Sales', 'Warehouse', '1100', '0', '0', '0', '1100', '1100', '', '0', 'D', 'A', 'New Jes', '2017-05-11 08:03:29', NULL, NULL),
(2, '2017-05-11-02', 1, '', '', '', '2017-05-11', 'Warehouse Sales', 'Warehouse', '2200', '0', '0', '0', '2200', '2200', '', '0', 'P', 'A', 'New Jes', '2017-05-11 08:05:06', NULL, NULL),
(3, '2017-06-01-03', 1, '', '', '', '2017-06-01', '', 'Warehouse', '1200', '0', '0', '0', '1200', '1200', '', '0', 'P', 'A', 'New Jes', '2017-06-01 11:08:08', NULL, NULL),
(4, '2017-06-01-04', 1, '', '', '', '2017-06-01', '', 'Shop', '9000', '0', '0', '0', '9000', '1000', '', '8000', 'D', 'A', 'New Jes', '2017-06-01 11:12:18', NULL, NULL),
(6, '2017-06-04-06', 0, 'Test Customer Name', '01712314259', 'Mirpur, Dhaka', '2017-06-04', '', 'Shop', '1100', '0', '0', '0', '1100', '1100', '', '0', 'D', 'A', 'New Jes', '2017-06-04 06:26:22', NULL, NULL),
(7, '2017-06-04-07', 0, 'Warehouse Customer', '01712314259', 'Mirpur, Dhaka', '2017-06-04', 'Test Warehouse Customer Sales', 'Warehouse', '2200', '0', '0', '0', '2200', '2200', '', '0', 'P', 'A', 'New Jes', '2017-06-04 06:28:57', NULL, NULL),
(8, '2017-06-04-08', 0, 'tedt', '01111', 'kjhg', '2017-06-04', '', 'Shop', '600', '0', '0', '0', '600', '500', '', '100', 'D', 'A', 'New Jes', '2017-06-04 06:33:41', NULL, NULL),
(9, '2017-06-04-09', 0, 'gfg', '12112121', 'rerer', '2017-06-04', '', 'Warehouse', '1200', '0', '0', '0', '1200', '1200', '', '0', 'P', 'A', 'New Jes', '2017-06-04 06:36:24', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sr_servicedetails`
--

CREATE TABLE IF NOT EXISTS `sr_servicedetails` (
`ServiceDetails_SlNo` int(11) NOT NULL,
  `ServiceMaster_IDNo` int(11) NOT NULL,
  `Product_IDNo` int(11) NOT NULL,
  `ServiceDetails_TotalQuantity` varchar(20) NOT NULL,
  `Purchase_Rate` varchar(19) DEFAULT NULL,
  `ServiceDetails_Rate` varchar(19) NOT NULL,
  `ServiceDetails_unit` varchar(20) NOT NULL,
  `ServiceDetails_Discount` varchar(19) NOT NULL,
  `ServiceDetails_Tax` varchar(19) NOT NULL,
  `ServiceDetails_Freight` varchar(19) NOT NULL,
  `ServiceDetails_TotalAmount` varchar(19) NOT NULL,
  `Status` char(1) NOT NULL,
  `AddBy` varchar(50) DEFAULT NULL,
  `AddTime` datetime DEFAULT NULL,
  `UpdateBy` varchar(50) DEFAULT NULL,
  `UpdateTime` datetime DEFAULT NULL,
  `packageName` varchar(200) NOT NULL,
  `packSellPrice` varchar(20) NOT NULL,
  `ServiceDetails_qty` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sr_servicemaster`
--

CREATE TABLE IF NOT EXISTS `sr_servicemaster` (
`ServiceMaster_SlNo` int(11) NOT NULL,
  `ServiceMaster_InvoiceNo` varchar(50) NOT NULL,
  `Po_No` varchar(20) NOT NULL,
  `Delevary_Invoice_No` varchar(20) NOT NULL,
  `Customer_IDNo` int(11) DEFAULT NULL,
  `ServiceMaster_SaleDate` date NOT NULL,
  `ServiceMaster_Description` longtext,
  `ServiceMaster_SaleType` varchar(50) NOT NULL,
  `ServiceMaster_TotalSaleAmount` varchar(20) NOT NULL,
  `ServiceMaster_TotalDiscountAmount` varchar(20) NOT NULL,
  `ServiceMaster_TaxAmount` varchar(20) NOT NULL,
  `ServiceMaster_Freight` varchar(20) NOT NULL,
  `ServiceMaster_SubTotalAmount` varchar(20) NOT NULL,
  `ServiceMaster_PaidAmount` varchar(20) NOT NULL,
  `ServiceMaster_paidby` varchar(30) NOT NULL,
  `ServiceMaster_DueAmount` varchar(20) NOT NULL,
  `ServiceMaster_TotalDue` varchar(20) NOT NULL DEFAULT '0.00',
  `Status` char(1) NOT NULL,
  `AddBy` varchar(50) DEFAULT NULL,
  `AddTime` datetime DEFAULT NULL,
  `UpdateBy` varchar(50) DEFAULT NULL,
  `UpdateTime` datetime DEFAULT NULL,
  `ServiceMaster_branchid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sr_supplier`
--

CREATE TABLE IF NOT EXISTS `sr_supplier` (
`Supplier_SlNo` int(11) NOT NULL,
  `Supplier_Code` varchar(50) NOT NULL,
  `Supplier_Name` varchar(150) NOT NULL,
  `Supplier_Type` varchar(50) NOT NULL,
  `Supplier_Phone` varchar(50) NOT NULL,
  `Supplier_Mobile` varchar(150) NOT NULL,
  `Supplier_Email` varchar(50) NOT NULL,
  `Supplier_OfficePhone` varchar(50) NOT NULL,
  `Supplier_Address` varchar(300) NOT NULL,
  `District_SlNo` int(11) NOT NULL,
  `Country_SlNo` int(11) NOT NULL,
  `Supplier_Web` varchar(150) NOT NULL,
  `Status` char(1) NOT NULL,
  `AddBy` varchar(50) DEFAULT NULL,
  `AddTime` datetime DEFAULT NULL,
  `UpdateBy` varchar(50) DEFAULT NULL,
  `UpdateTime` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sr_supplier`
--

INSERT INTO `sr_supplier` (`Supplier_SlNo`, `Supplier_Code`, `Supplier_Name`, `Supplier_Type`, `Supplier_Phone`, `Supplier_Mobile`, `Supplier_Email`, `Supplier_OfficePhone`, `Supplier_Address`, `District_SlNo`, `Country_SlNo`, `Supplier_Web`, `Status`, `AddBy`, `AddTime`, `UpdateBy`, `UpdateTime`) VALUES
(1, '001', 'Supplier 1', 'Local', '01712314259', '01712314259', 'supplier@gmail.com', '', 'Dhaka', 1, 1, '', '', 'New Jes', '2017-05-07 04:00:58', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sr_supplier_payment`
--

CREATE TABLE IF NOT EXISTS `sr_supplier_payment` (
`SPayment_id` int(11) NOT NULL,
  `SPayment_date` date NOT NULL,
  `SPayment_invoice` varchar(20) NOT NULL,
  `SPayment_customerID` varchar(20) NOT NULL,
  `SPayment_amount` varchar(20) NOT NULL,
  `SPayment_Paymentby` varchar(20) NOT NULL,
  `SPayment_notes` varchar(225) NOT NULL,
  `SPayment_brunchid` int(11) NOT NULL,
  `SPayment_Addby` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sr_supplier_payment`
--

INSERT INTO `sr_supplier_payment` (`SPayment_id`, `SPayment_date`, `SPayment_invoice`, `SPayment_customerID`, `SPayment_amount`, `SPayment_Paymentby`, `SPayment_notes`, `SPayment_brunchid`, `SPayment_Addby`) VALUES
(1, '2017-05-09', '2017-05-09-01', '1', '800', '', 'Test', 0, 'New Jes'),
(2, '2017-05-09', '2017-05-09-02', '1', '3600', '', '', 0, 'New Jes'),
(3, '2017-05-09', '2017-05-09-03', '1', '5400', '', '', 0, 'New Jes'),
(4, '2017-05-09', '2017-05-09-04', '1', '1500', '', '', 0, 'New Jes'),
(5, '2017-05-09', '2017-05-09-05', '1', '2600', '', '', 0, 'New Jes'),
(6, '2017-05-09', '2017-05-09-06', '1', '1000', '', '', 0, 'New Jes'),
(7, '2017-06-04', '2017-06-04-07', '1', '1000', '', '', 0, 'New Jes'),
(8, '2017-06-04', '2017-06-04-08', '1', '8400', '', 'Test', 0, 'New Jes');

-- --------------------------------------------------------

--
-- Table structure for table `sr_transferdetails`
--

CREATE TABLE IF NOT EXISTS `sr_transferdetails` (
`TransferDetails_SiNo` int(11) NOT NULL,
  `TransferMaster_IDNo` int(11) NOT NULL,
  `Product_IDNo` int(11) NOT NULL,
  `TransferDetails_TotalQuantity` varchar(20) NOT NULL,
  `TransferDetails_unit` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sr_transferdetails`
--

INSERT INTO `sr_transferdetails` (`TransferDetails_SiNo`, `TransferMaster_IDNo`, `Product_IDNo`, `TransferDetails_TotalQuantity`, `TransferDetails_unit`) VALUES
(1, 1, 1, '10', 'PCS'),
(2, 2, 1, '20', 'PCS'),
(3, 3, 1, '15', 'PCS');

-- --------------------------------------------------------

--
-- Table structure for table `sr_transfermaster`
--

CREATE TABLE IF NOT EXISTS `sr_transfermaster` (
`TransferMaster_SiNo` int(11) NOT NULL,
  `TransferMaster_InvoiceNo` varchar(50) NOT NULL,
  `TransferMaster_TransferTo` varchar(20) DEFAULT NULL,
  `TransferMaster__Date` date NOT NULL,
  `TransferMaster__Description` longtext,
  `Status` char(1) NOT NULL DEFAULT 'A',
  `AddBy` varchar(50) DEFAULT NULL,
  `AddTime` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sr_transfermaster`
--

INSERT INTO `sr_transfermaster` (`TransferMaster_SiNo`, `TransferMaster_InvoiceNo`, `TransferMaster_TransferTo`, `TransferMaster__Date`, `TransferMaster__Description`, `Status`, `AddBy`, `AddTime`) VALUES
(1, '2017-06-06-01', 'Warehouse', '2017-06-06', 'dfdf', 'A', 'New Jes', '2017-06-06 05:20:03'),
(2, '2017-06-06-02', 'Warehouse', '2017-06-06', 'trtrtrtrt', 'A', 'New Jes', '2017-06-06 05:24:12'),
(3, '2017-06-06-03', 'Warehouse', '2017-06-06', 'trtrtr', 'A', 'New Jes', '2017-06-06 05:25:36');

-- --------------------------------------------------------

--
-- Table structure for table `sr_unit`
--

CREATE TABLE IF NOT EXISTS `sr_unit` (
`Unit_SlNo` int(11) NOT NULL,
  `Unit_Name` varchar(150) NOT NULL,
  `Status` char(1) NOT NULL,
  `AddBy` varchar(50) DEFAULT NULL,
  `AddTime` datetime DEFAULT NULL,
  `UpdateBy` varchar(50) DEFAULT NULL,
  `UpdateTime` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sr_unit`
--

INSERT INTO `sr_unit` (`Unit_SlNo`, `Unit_Name`, `Status`, `AddBy`, `AddTime`, `UpdateBy`, `UpdateTime`) VALUES
(1, 'PCS', '', 'Manago soft', '2016-05-28 07:43:35', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sr_warehouse_details`
--

CREATE TABLE IF NOT EXISTS `sr_warehouse_details` (
`WHDetails_SlNo` int(11) NOT NULL,
  `WHMaster_IDNo` int(11) NOT NULL,
  `Product_IDNo` int(11) NOT NULL,
  `SaleDetails_TotalQuantity` varchar(20) NOT NULL,
  `Purchase_Rate` varchar(19) DEFAULT NULL,
  `SaleDetails_Rate` varchar(19) NOT NULL,
  `SaleDetails_unit` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sr_warehouse_master`
--

CREATE TABLE IF NOT EXISTS `sr_warehouse_master` (
`WHMaster_SlNo` int(11) NOT NULL,
  `SaleMaster_InvoiceNo` varchar(50) NOT NULL,
  `SalseCustomer_IDNo` int(11) DEFAULT NULL,
  `SaleMaster_SaleDate` date NOT NULL,
  `SaleMaster_Description` longtext,
  `SaleMaster_SaleType` varchar(50) NOT NULL,
  `SaleMaster_TotalSaleAmount` varchar(20) NOT NULL,
  `SaleMaster_TotalDiscountAmount` varchar(20) NOT NULL,
  `SaleMaster_TaxAmount` varchar(20) NOT NULL,
  `SaleMaster_Freight` varchar(20) NOT NULL,
  `SaleMaster_SubTotalAmount` varchar(20) NOT NULL,
  `SaleMaster_PaidAmount` varchar(20) NOT NULL,
  `SaleMaster_DueAmount` varchar(20) NOT NULL,
  `Status` char(1) NOT NULL DEFAULT 'P',
  `AddBy` varchar(50) DEFAULT NULL,
  `AddTime` datetime DEFAULT NULL,
  `UpdateBy` varchar(50) DEFAULT NULL,
  `UpdateTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brunch`
--

CREATE TABLE IF NOT EXISTS `tbl_brunch` (
`brunch_id` int(11) NOT NULL,
  `Brunch_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_check_pay`
--

CREATE TABLE IF NOT EXISTS `tbl_check_pay` (
`CheckPay_SINo` int(11) unsigned NOT NULL,
  `SalesInvoiceno` varchar(25) NOT NULL,
  `CompanyName` varchar(200) NOT NULL,
  `CheckNo` varchar(50) NOT NULL,
  `BankName` varchar(200) NOT NULL,
  `BrunchName` varchar(200) NOT NULL,
  `CheckDate` varchar(20) NOT NULL,
  `CheckStatus` varchar(20) NOT NULL,
  `AddBy` varchar(200) NOT NULL,
  `AddTime` datetime NOT NULL,
  `UpdatedBy` varchar(200) NOT NULL,
  `UpdatedTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_moneyreceipt`
--

CREATE TABLE IF NOT EXISTS `tbl_moneyreceipt` (
`MoneyReceipt_SINo` int(11) NOT NULL,
  `MoneyReceipt_No` varchar(20) NOT NULL,
  `MoneyReceipt_Name` varchar(50) NOT NULL,
  `Money_receipt_Paytype` varchar(20) NOT NULL,
  `Money_receipt_accountNo` varchar(50) NOT NULL,
  `MoneyReceipt_ChequeNo` varchar(50) NOT NULL,
  `MoneyReceipt_Amount` varchar(20) NOT NULL,
  `MoneyReceipt_PayDate` date NOT NULL,
  `Status` char(1) NOT NULL,
  `AddBy` varchar(50) NOT NULL,
  `AddTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE IF NOT EXISTS `tbl_product` (
`Product_SlNo` int(11) NOT NULL,
  `Product_Code` varchar(50) NOT NULL,
  `Product_Name` varchar(150) NOT NULL,
  `Product_type` varchar(15) NOT NULL,
  `Product_BarCode` varchar(100) NOT NULL,
  `ProductCategory_ID` int(11) NOT NULL,
  `Product_IsRawMaterial` varchar(100) NOT NULL,
  `Product_IsFinishedGoods` varchar(100) NOT NULL,
  `Product_ReOrederLevel` int(11) NOT NULL,
  `Product_Purchase_Rate` float NOT NULL,
  `Product_SellingPrice` float NOT NULL,
  `Unit_ID` int(11) NOT NULL,
  `Status` char(1) NOT NULL,
  `AddBy` varchar(100) NOT NULL,
  `AddTime` varchar(30) NOT NULL,
  `UpdateBy` varchar(50) NOT NULL,
  `UpdateTime` varchar(30) NOT NULL,
  `Product_packageID` int(11) NOT NULL,
  `product_create_pack_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`Product_SlNo`, `Product_Code`, `Product_Name`, `Product_type`, `Product_BarCode`, `ProductCategory_ID`, `Product_IsRawMaterial`, `Product_IsFinishedGoods`, `Product_ReOrederLevel`, `Product_Purchase_Rate`, `Product_SellingPrice`, `Unit_ID`, `Status`, `AddBy`, `AddTime`, `UpdateBy`, `UpdateTime`, `Product_packageID`, `product_create_pack_id`) VALUES
(1, 'P001', 'Product 1', 'Product', '', 1, '', '', 50, 100, 120, 1, '', 'New Jes', '2017-05-07 04:13:31', '', '', 0, 0),
(2, 'P002', 'Product 2', 'Product', '', 1, '', '', 30, 50, 60, 1, '', 'New Jes', '2017-05-07 04:14:10', '', '', 0, 0),
(3, 'P003', 'Product 3', 'Product', '', 1, '', '', 20, 30, 40, 1, '', 'New Jes', '2017-05-07 04:14:50', '', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_productcategory`
--

CREATE TABLE IF NOT EXISTS `tbl_productcategory` (
`ProductCategory_SlNo` int(11) NOT NULL,
  `ProductCategory_Name` varchar(150) NOT NULL,
  `ProductCategory_Description` varchar(300) NOT NULL,
  `Status` char(1) NOT NULL,
  `AddBy` varchar(50) NOT NULL,
  `AddTime` varchar(30) NOT NULL,
  `UpdateBy` varchar(50) NOT NULL,
  `UpdateTime` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stock_register`
--

CREATE TABLE IF NOT EXISTS `tbl_stock_register` (
`Sino` int(11) NOT NULL,
  `Invoice` varchar(20) NOT NULL,
  `Date` date NOT NULL,
  `ProductID` int(11) NOT NULL,
  `Store` varchar(20) NOT NULL,
  `StockType` varchar(20) NOT NULL,
  `InQty` float NOT NULL,
  `OutQty` float NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_stock_register`
--

INSERT INTO `tbl_stock_register` (`Sino`, `Invoice`, `Date`, `ProductID`, `Store`, `StockType`, `InQty`, `OutQty`) VALUES
(1, '2017-05-09-01', '2017-05-09', 3, 'Warehouse', 'Product Purchase', 10, 0),
(2, '2017-05-09-01', '2017-05-09', 2, 'Warehouse', 'Product Purchase', 10, 0),
(3, '2017-05-09-01', '2017-05-09', 1, 'Warehouse', 'Product Purchase', 10, 0),
(4, '2017-05-09-02', '2017-05-09', 1, 'Warehouse', 'Product Purchase', 20, 0),
(5, '2017-05-09-02', '2017-05-09', 3, 'Warehouse', 'Product Purchase', 20, 0),
(6, '2017-05-09-02', '2017-05-09', 2, 'Warehouse', 'Product Purchase', 20, 0),
(7, '2017-05-09-03', '2017-05-09', 1, 'Shop', 'Product Purchase', 30, 0),
(8, '2017-05-09-03', '2017-05-09', 3, 'Shop', 'Product Purchase', 30, 0),
(9, '2017-05-09-03', '2017-05-09', 2, 'Shop', 'Product Purchase', 30, 0),
(10, '2017-05-09-04', '2017-05-09', 1, 'Shop', 'Product Purchase', 20, 0),
(11, '2017-05-09-04', '2017-05-09', 2, 'Shop', 'Product Purchase', 20, 0),
(12, '2017-05-09-04', '2017-05-09', 3, 'Shop', 'Product Purchase', 20, 0),
(13, '2017-05-09-05', '2017-05-09', 1, 'Warehouse', 'Product Purchase', 20, 0),
(14, '2017-05-09-05', '2017-05-09', 3, 'Warehouse', 'Product Purchase', 20, 0),
(15, '2017-05-09-06', '2017-05-09', 2, 'Warehouse', 'Product Purchase', 20, 0),
(16, '2017-05-11-01', '2017-05-11', 3, 'Warehouse', 'Product Sales', 0, 5),
(17, '2017-05-11-01', '2017-05-11', 2, 'Warehouse', 'Product Sales', 0, 5),
(18, '2017-05-11-01', '2017-05-11', 1, 'Warehouse', 'Product Sales', 0, 5),
(19, '2017-05-11-02', '2017-05-11', 2, 'Warehouse', 'Product Sales', 0, 10),
(20, '2017-05-11-02', '2017-05-11', 1, 'Warehouse', 'Product Sales', 0, 10),
(21, '2017-05-11-02', '2017-05-11', 3, 'Warehouse', 'Product Sales', 0, 10),
(22, '2017-06-01-03', '2017-06-01', 1, 'Warehouse', 'Product Sales', 0, 10),
(23, '2017-06-01-04', '2017-06-01', 1, 'Shop', 'Product Sales', 0, 50),
(24, '2017-06-01-04', '2017-06-01', 2, 'Shop', 'Product Sales', 0, 50),
(25, '2017-06-04-07', '2017-06-04', 1, 'Shop', 'Product Purchase', 10, 0),
(26, '2017-06-04-05', '2017-06-04', 1, 'Shop', 'Product Sales', 0, 1),
(27, '2017-06-04-08', '2017-06-04', 1, 'Shop', 'Product Purchase', 50, 0),
(28, '2017-06-04-08', '2017-06-04', 2, 'Shop', 'Product Purchase', 50, 0),
(29, '2017-06-04-08', '2017-06-04', 3, 'Shop', 'Product Purchase', 100, 0),
(30, '2017-06-04-06', '2017-06-04', 1, 'Shop', 'Product Sales', 0, 5),
(31, '2017-06-04-06', '2017-06-04', 2, 'Shop', 'Product Sales', 0, 5),
(32, '2017-06-04-06', '2017-06-04', 3, 'Shop', 'Product Sales', 0, 5),
(33, '2017-06-04-07', '2017-06-04', 1, 'Warehouse', 'Product Sales', 0, 10),
(34, '2017-06-04-07', '2017-06-04', 2, 'Warehouse', 'Product Sales', 0, 10),
(35, '2017-06-04-07', '2017-06-04', 3, 'Warehouse', 'Product Sales', 0, 10),
(36, '2017-06-04-08', '2017-06-04', 2, 'Shop', 'Product Sales', 0, 10),
(37, '2017-06-04-09', '2017-06-04', 1, 'Warehouse', 'Product Sales', 0, 10);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_unit`
--

CREATE TABLE IF NOT EXISTS `tbl_unit` (
`Unit_SlNo` int(11) NOT NULL,
  `Unit_Name` varchar(150) NOT NULL,
  `Status` char(1) NOT NULL,
  `AddBy` varchar(50) DEFAULT NULL,
  `AddTime` datetime DEFAULT NULL,
  `UpdateBy` varchar(50) DEFAULT NULL,
  `UpdateTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
`User_SlNo` int(11) NOT NULL,
  `User_ID` varchar(50) NOT NULL,
  `FullName` varchar(150) NOT NULL,
  `User_Name` varchar(150) NOT NULL,
  `userBrunch_id` int(11) NOT NULL,
  `User_Password` varchar(50) NOT NULL,
  `UserType` varchar(50) NOT NULL,
  `Status` char(1) NOT NULL DEFAULT 'a',
  `AddBy` varchar(50) DEFAULT NULL,
  `AddTime` datetime DEFAULT NULL,
  `UpdateBy` varchar(50) DEFAULT NULL,
  `UpdateTime` datetime DEFAULT NULL,
  `Brunch_ID` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`User_SlNo`, `User_ID`, `FullName`, `User_Name`, `userBrunch_id`, `User_Password`, `UserType`, `Status`, `AddBy`, `AddTime`, `UpdateBy`, `UpdateTime`, `Brunch_ID`) VALUES
(1, '', 'New Jes', 'newjes', 0, '21232f297a57a5a743894a0e4a801fc3', 'Admin', 'a', NULL, '2017-05-07 09:32:40', NULL, NULL, 0),
(2, '', 'Warehouse', 'warehouse', 0, '372d30dd2849813ef674855253900679', 'Warehouse Manager', 'a', NULL, NULL, NULL, NULL, 0),
(3, '', 'Manager', 'manager', 0, '1d0258c2440a8d19e716292b231e3190', 'Manager', 'a', NULL, NULL, NULL, NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
 ADD PRIMARY KEY (`session_id`), ADD KEY `last_activity_idx` (`last_activity`);

--
-- Indexes for table `sr_account`
--
ALTER TABLE `sr_account`
 ADD PRIMARY KEY (`Acc_SlNo`);

--
-- Indexes for table `sr_cashregister`
--
ALTER TABLE `sr_cashregister`
 ADD PRIMARY KEY (`Transaction_ID`);

--
-- Indexes for table `sr_cashtransaction`
--
ALTER TABLE `sr_cashtransaction`
 ADD PRIMARY KEY (`Tr_SlNo`);

--
-- Indexes for table `sr_challandetails`
--
ALTER TABLE `sr_challandetails`
 ADD PRIMARY KEY (`ChallanDetails_SlNo`);

--
-- Indexes for table `sr_challanmaster`
--
ALTER TABLE `sr_challanmaster`
 ADD PRIMARY KEY (`ChallanMaster_SlNo`);

--
-- Indexes for table `sr_company`
--
ALTER TABLE `sr_company`
 ADD PRIMARY KEY (`Company_SlNo`);

--
-- Indexes for table `sr_country`
--
ALTER TABLE `sr_country`
 ADD PRIMARY KEY (`Country_SlNo`);

--
-- Indexes for table `sr_currentinventory`
--
ALTER TABLE `sr_currentinventory`
 ADD PRIMARY KEY (`CurrentInventory_SlNo`);

--
-- Indexes for table `sr_customer`
--
ALTER TABLE `sr_customer`
 ADD PRIMARY KEY (`Customer_SlNo`);

--
-- Indexes for table `sr_customer_payment`
--
ALTER TABLE `sr_customer_payment`
 ADD PRIMARY KEY (`CPayment_id`);

--
-- Indexes for table `sr_damage`
--
ALTER TABLE `sr_damage`
 ADD PRIMARY KEY (`Damage_SlNo`);

--
-- Indexes for table `sr_damagedetails`
--
ALTER TABLE `sr_damagedetails`
 ADD PRIMARY KEY (`DamageDetails_SlNo`);

--
-- Indexes for table `sr_department`
--
ALTER TABLE `sr_department`
 ADD PRIMARY KEY (`Department_SlNo`);

--
-- Indexes for table `sr_designation`
--
ALTER TABLE `sr_designation`
 ADD PRIMARY KEY (`Designation_SlNo`);

--
-- Indexes for table `sr_district`
--
ALTER TABLE `sr_district`
 ADD PRIMARY KEY (`District_SlNo`);

--
-- Indexes for table `sr_employee`
--
ALTER TABLE `sr_employee`
 ADD PRIMARY KEY (`Employee_SlNo`);

--
-- Indexes for table `sr_package`
--
ALTER TABLE `sr_package`
 ADD PRIMARY KEY (`package_ID`);

--
-- Indexes for table `sr_package_create`
--
ALTER TABLE `sr_package_create`
 ADD PRIMARY KEY (`create_ID`);

--
-- Indexes for table `sr_productcategory`
--
ALTER TABLE `sr_productcategory`
 ADD PRIMARY KEY (`ProductCategory_SlNo`);

--
-- Indexes for table `sr_purchasedetails`
--
ALTER TABLE `sr_purchasedetails`
 ADD PRIMARY KEY (`PurchaseDetails_SlNo`);

--
-- Indexes for table `sr_purchaseinventory`
--
ALTER TABLE `sr_purchaseinventory`
 ADD PRIMARY KEY (`PurchaseInventory_SlNo`);

--
-- Indexes for table `sr_purchasemaster`
--
ALTER TABLE `sr_purchasemaster`
 ADD PRIMARY KEY (`PurchaseMaster_SlNo`);

--
-- Indexes for table `sr_purchasereturn`
--
ALTER TABLE `sr_purchasereturn`
 ADD PRIMARY KEY (`PurchaseReturn_SlNo`);

--
-- Indexes for table `sr_purchasereturndetails`
--
ALTER TABLE `sr_purchasereturndetails`
 ADD PRIMARY KEY (`PurchaseReturnDetails_SlNo`);

--
-- Indexes for table `sr_saledetails`
--
ALTER TABLE `sr_saledetails`
 ADD PRIMARY KEY (`SaleDetails_SlNo`);

--
-- Indexes for table `sr_saleinventory`
--
ALTER TABLE `sr_saleinventory`
 ADD PRIMARY KEY (`SaleInventory_SlNo`);

--
-- Indexes for table `sr_salereturn`
--
ALTER TABLE `sr_salereturn`
 ADD PRIMARY KEY (`SaleReturn_SlNo`);

--
-- Indexes for table `sr_salereturndetails`
--
ALTER TABLE `sr_salereturndetails`
 ADD PRIMARY KEY (`SaleReturnDetails_SlNo`);

--
-- Indexes for table `sr_salesmaster`
--
ALTER TABLE `sr_salesmaster`
 ADD PRIMARY KEY (`SaleMaster_SlNo`);

--
-- Indexes for table `sr_servicedetails`
--
ALTER TABLE `sr_servicedetails`
 ADD PRIMARY KEY (`ServiceDetails_SlNo`);

--
-- Indexes for table `sr_servicemaster`
--
ALTER TABLE `sr_servicemaster`
 ADD PRIMARY KEY (`ServiceMaster_SlNo`);

--
-- Indexes for table `sr_supplier`
--
ALTER TABLE `sr_supplier`
 ADD PRIMARY KEY (`Supplier_SlNo`);

--
-- Indexes for table `sr_supplier_payment`
--
ALTER TABLE `sr_supplier_payment`
 ADD PRIMARY KEY (`SPayment_id`);

--
-- Indexes for table `sr_transferdetails`
--
ALTER TABLE `sr_transferdetails`
 ADD PRIMARY KEY (`TransferDetails_SiNo`);

--
-- Indexes for table `sr_transfermaster`
--
ALTER TABLE `sr_transfermaster`
 ADD PRIMARY KEY (`TransferMaster_SiNo`);

--
-- Indexes for table `sr_unit`
--
ALTER TABLE `sr_unit`
 ADD PRIMARY KEY (`Unit_SlNo`);

--
-- Indexes for table `sr_warehouse_details`
--
ALTER TABLE `sr_warehouse_details`
 ADD PRIMARY KEY (`WHDetails_SlNo`);

--
-- Indexes for table `sr_warehouse_master`
--
ALTER TABLE `sr_warehouse_master`
 ADD PRIMARY KEY (`WHMaster_SlNo`);

--
-- Indexes for table `tbl_brunch`
--
ALTER TABLE `tbl_brunch`
 ADD PRIMARY KEY (`brunch_id`);

--
-- Indexes for table `tbl_check_pay`
--
ALTER TABLE `tbl_check_pay`
 ADD PRIMARY KEY (`CheckPay_SINo`);

--
-- Indexes for table `tbl_moneyreceipt`
--
ALTER TABLE `tbl_moneyreceipt`
 ADD PRIMARY KEY (`MoneyReceipt_SINo`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
 ADD PRIMARY KEY (`Product_SlNo`);

--
-- Indexes for table `tbl_productcategory`
--
ALTER TABLE `tbl_productcategory`
 ADD PRIMARY KEY (`ProductCategory_SlNo`);

--
-- Indexes for table `tbl_stock_register`
--
ALTER TABLE `tbl_stock_register`
 ADD PRIMARY KEY (`Sino`);

--
-- Indexes for table `tbl_unit`
--
ALTER TABLE `tbl_unit`
 ADD PRIMARY KEY (`Unit_SlNo`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
 ADD PRIMARY KEY (`User_SlNo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sr_account`
--
ALTER TABLE `sr_account`
MODIFY `Acc_SlNo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sr_cashregister`
--
ALTER TABLE `sr_cashregister`
MODIFY `Transaction_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sr_cashtransaction`
--
ALTER TABLE `sr_cashtransaction`
MODIFY `Tr_SlNo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `sr_challandetails`
--
ALTER TABLE `sr_challandetails`
MODIFY `ChallanDetails_SlNo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sr_challanmaster`
--
ALTER TABLE `sr_challanmaster`
MODIFY `ChallanMaster_SlNo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sr_company`
--
ALTER TABLE `sr_company`
MODIFY `Company_SlNo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sr_country`
--
ALTER TABLE `sr_country`
MODIFY `Country_SlNo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sr_currentinventory`
--
ALTER TABLE `sr_currentinventory`
MODIFY `CurrentInventory_SlNo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sr_customer`
--
ALTER TABLE `sr_customer`
MODIFY `Customer_SlNo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sr_customer_payment`
--
ALTER TABLE `sr_customer_payment`
MODIFY `CPayment_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `sr_damage`
--
ALTER TABLE `sr_damage`
MODIFY `Damage_SlNo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sr_damagedetails`
--
ALTER TABLE `sr_damagedetails`
MODIFY `DamageDetails_SlNo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sr_department`
--
ALTER TABLE `sr_department`
MODIFY `Department_SlNo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sr_designation`
--
ALTER TABLE `sr_designation`
MODIFY `Designation_SlNo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sr_district`
--
ALTER TABLE `sr_district`
MODIFY `District_SlNo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sr_employee`
--
ALTER TABLE `sr_employee`
MODIFY `Employee_SlNo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sr_package`
--
ALTER TABLE `sr_package`
MODIFY `package_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sr_package_create`
--
ALTER TABLE `sr_package_create`
MODIFY `create_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sr_productcategory`
--
ALTER TABLE `sr_productcategory`
MODIFY `ProductCategory_SlNo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sr_purchasedetails`
--
ALTER TABLE `sr_purchasedetails`
MODIFY `PurchaseDetails_SlNo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `sr_purchaseinventory`
--
ALTER TABLE `sr_purchaseinventory`
MODIFY `PurchaseInventory_SlNo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `sr_purchasemaster`
--
ALTER TABLE `sr_purchasemaster`
MODIFY `PurchaseMaster_SlNo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `sr_purchasereturn`
--
ALTER TABLE `sr_purchasereturn`
MODIFY `PurchaseReturn_SlNo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sr_purchasereturndetails`
--
ALTER TABLE `sr_purchasereturndetails`
MODIFY `PurchaseReturnDetails_SlNo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sr_saledetails`
--
ALTER TABLE `sr_saledetails`
MODIFY `SaleDetails_SlNo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `sr_saleinventory`
--
ALTER TABLE `sr_saleinventory`
MODIFY `SaleInventory_SlNo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `sr_salereturn`
--
ALTER TABLE `sr_salereturn`
MODIFY `SaleReturn_SlNo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sr_salereturndetails`
--
ALTER TABLE `sr_salereturndetails`
MODIFY `SaleReturnDetails_SlNo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sr_salesmaster`
--
ALTER TABLE `sr_salesmaster`
MODIFY `SaleMaster_SlNo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `sr_servicedetails`
--
ALTER TABLE `sr_servicedetails`
MODIFY `ServiceDetails_SlNo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sr_servicemaster`
--
ALTER TABLE `sr_servicemaster`
MODIFY `ServiceMaster_SlNo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sr_supplier`
--
ALTER TABLE `sr_supplier`
MODIFY `Supplier_SlNo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sr_supplier_payment`
--
ALTER TABLE `sr_supplier_payment`
MODIFY `SPayment_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `sr_transferdetails`
--
ALTER TABLE `sr_transferdetails`
MODIFY `TransferDetails_SiNo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `sr_transfermaster`
--
ALTER TABLE `sr_transfermaster`
MODIFY `TransferMaster_SiNo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `sr_unit`
--
ALTER TABLE `sr_unit`
MODIFY `Unit_SlNo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sr_warehouse_details`
--
ALTER TABLE `sr_warehouse_details`
MODIFY `WHDetails_SlNo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sr_warehouse_master`
--
ALTER TABLE `sr_warehouse_master`
MODIFY `WHMaster_SlNo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_brunch`
--
ALTER TABLE `tbl_brunch`
MODIFY `brunch_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_check_pay`
--
ALTER TABLE `tbl_check_pay`
MODIFY `CheckPay_SINo` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_moneyreceipt`
--
ALTER TABLE `tbl_moneyreceipt`
MODIFY `MoneyReceipt_SINo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
MODIFY `Product_SlNo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_productcategory`
--
ALTER TABLE `tbl_productcategory`
MODIFY `ProductCategory_SlNo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_stock_register`
--
ALTER TABLE `tbl_stock_register`
MODIFY `Sino` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `tbl_unit`
--
ALTER TABLE `tbl_unit`
MODIFY `Unit_SlNo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
MODIFY `User_SlNo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
