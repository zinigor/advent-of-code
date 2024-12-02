<?php

$instructions = 'LRRLRRRLRRRLLRRLRRLRLRLRRLLRRLRRLRRRLLLRRRLRRRLRRRLLRRRLRRLLRRLRRLRLRRRLRRLRLRRLRRRLLRRLLRLRRRLLRRLRRLLLRLRRRLRLRLRLLRRRLRLLRRRLRLRRRLRRRLLRRLRRRLLRRLRLLRLRRLLLRRLRRLLLRLLRLRRRLRLRLRRRLRRLLRRRLRLRLRRLRRRLRLRRLRRLRRRLRRRLRRRLRRRLRRLLRRLRLLRRLLRRRLRLLRLRLRRLRRLRLRLRRRLRLRLRRLRLRRLRRRR';

$nodes = [
	'FPF' => [ 'PTN', 'MPT' ],
	'DGM' => [ 'KXM', 'PRM' ],
	'FKB' => [ 'JLC', 'MBX' ],
	'XCJ' => [ 'DCJ', 'TSH' ],
	'JVH' => [ 'VCH', 'SMV' ],
	'BXL' => [ 'HLB', 'NVF' ],
	'GVD' => [ 'FSQ', 'MFD' ],
	'CDJ' => [ 'SMM', 'HHS' ],
	'BGM' => [ 'FHB', 'LKH' ],
	'FBP' => [ 'HHS', 'SMM' ],
	'LTK' => [ 'TCV', 'GQX' ],
	'LDM' => [ 'MRM', 'JKJ' ],
	'RDK' => [ 'KBL', 'GHP' ],
	'BJB' => [ 'XBN', 'BXG' ],
	'KST' => [ 'BGX', 'VFS' ],
	'VKM' => [ 'MFR', 'CJP' ],
	'CSG' => [ 'GGJ', 'JHH' ],
	'JFS' => [ 'QCG', 'XFR' ],
	'MDV' => [ 'FPQ', 'NRX' ],
	'QHF' => [ 'PJP', 'QHX' ],
	'DHM' => [ 'LJC', 'PDS' ],
	'MMV' => [ 'CHS', 'FXX' ],
	'CQP' => [ 'LFN', 'GSD' ],
	'RDT' => [ 'NVG', 'NVG' ],
	'XFN' => [ 'HFM', 'LTK' ],
	'MFD' => [ 'RKJ', 'XGN' ],
	'DTD' => [ 'JBV', 'JBV' ],
	'KJG' => [ 'PCC', 'PPR' ],
	'GLH' => [ 'JRN', 'BLK' ],
	'KBV' => [ 'MCQ', 'MCS' ],
	'LQF' => [ 'KDR', 'GFC' ],
	'GGB' => [ 'JGL', 'RRM' ],
	'BQX' => [ 'QKQ', 'NSG' ],
	'SVS' => [ 'SQL', 'FXL' ],
	'GMC' => [ 'BHG', 'GPC' ],
	'KPZ' => [ 'HLV', 'RVH' ],
	'RQB' => [ 'TDV', 'XPN' ],
	'GVR' => [ 'SXD', 'QRB' ],
	'MNX' => [ 'DLT', 'CMJ' ],
	'QDM' => [ 'TKN', 'VDH' ],
	'CCB' => [ 'KPR', 'QCK' ],
	'BVF' => [ 'QJX', 'FKK' ],
	'TJB' => [ 'HKV', 'BCP' ],
	'BHC' => [ 'SSN', 'HHH' ],
	'NTN' => [ 'RPT', 'PVF' ],
	'NDP' => [ 'BJQ', 'MGH' ],
	'PJP' => [ 'NTN', 'FSR' ],
	'BLL' => [ 'MTQ', 'SNQ' ],
	'RNP' => [ 'RTD', 'PGM' ],
	'PVF' => [ 'BMP', 'LPM' ],
	'QFL' => [ 'NNS', 'GLR' ],
	'VRG' => [ 'GGV', 'DMG' ],
	'XRX' => [ 'TTR', 'LXS' ],
	'MBH' => [ 'RHX', 'GKF' ],
	'CXD' => [ 'LFN', 'GSD' ],
	'FFK' => [ 'LDG', 'VHS' ],
	'NHM' => [ 'BLM', 'XQD' ],
	'TNB' => [ 'KSS', 'FSB' ],
	'VLX' => [ 'KCF', 'VXL' ],
	'DDF' => [ 'TNK', 'FBS' ],
	'GQR' => [ 'BGM', 'MGR' ],
	'BPQ' => [ 'FHD', 'MJT' ],
	'KPR' => [ 'SDL', 'NMQ' ],
	'CNL' => [ 'QFP', 'XPV' ],
	'HVA' => [ 'BRQ', 'XPL' ],
	'PHF' => [ 'LHF', 'HVR' ],
	'TNZ' => [ 'XCM', 'BFL' ],
	'NDJ' => [ 'GCQ', 'RTL' ],
	'HCT' => [ 'PQT', 'VVB' ],
	'JNH' => [ 'GVV', 'JMC' ],
	'CNV' => [ 'SDP', 'NQR' ],
	'GGV' => [ 'RHT', 'SLG' ],
	'PRX' => [ 'FSD', 'KST' ],
	'BLM' => [ 'KKQ', 'CSG' ],
	'JRN' => [ 'GGK', 'GBF' ],
	'DJK' => [ 'GQJ', 'JKB' ],
	'RVH' => [ 'FXJ', 'JVN' ],
	'RXF' => [ 'CHG', 'GDT' ],
	'MBX' => [ 'KJM', 'XFN' ],
	'HLV' => [ 'JVN', 'FXJ' ],
	'XDG' => [ 'HJM', 'KCT' ],
	'LPM' => [ 'RCG', 'RHG' ],
	'GLP' => [ 'XDM', 'XNC' ],
	'HQP' => [ 'JXQ', 'XPT' ],
	'CXF' => [ 'SCV', 'PHF' ],
	'QJT' => [ 'FJN', 'GHV' ],
	'MPL' => [ 'HSQ', 'FKN' ],
	'SDP' => [ 'LCQ', 'GRV' ],
	'CDQ' => [ 'JLV', 'LLD' ],
	'HHA' => [ 'BFL', 'XCM' ],
	'GPS' => [ 'VLX', 'CPL' ],
	'BXZ' => [ 'KSN', 'VKP' ],
	'PGM' => [ 'LJV', 'CDQ' ],
	'PKG' => [ 'VQF', 'FXC' ],
	'XPL' => [ 'LBN', 'DMV' ],
	'BJJ' => [ 'TVV', 'MNX' ],
	'HLB' => [ 'SNN', 'HNH' ],
	'CDV' => [ 'TNB', 'FSN' ],
	'FXC' => [ 'CLF', 'HSC' ],
	'JFM' => [ 'LSR', 'CNL' ],
	'CMV' => [ 'DHQ', 'DJR' ],
	'LDN' => [ 'BCQ', 'JMS' ],
	'XNC' => [ 'JLS', 'KXS' ],
	'SNN' => [ 'NGM', 'MFJ' ],
	'CND' => [ 'RDL', 'GJJ' ],
	'SKT' => [ 'FCM', 'MRC' ],
	'QRB' => [ 'BCG', 'HRR' ],
	'XNK' => [ 'LJC', 'PDS' ],
	'DGK' => [ 'KBF', 'SRB' ],
	'LNL' => [ 'FSD', 'KST' ],
	'PCM' => [ 'PDL', 'JFS' ],
	'BSV' => [ 'LSR', 'CNL' ],
	'SMX' => [ 'TKL', 'QPF' ],
	'XMS' => [ 'MDB', 'PKP' ],
	'XPT' => [ 'LDM', 'PKV' ],
	'RLB' => [ 'XFT', 'PKM' ],
	'VVV' => [ 'NRX', 'FPQ' ],
	'MGB' => [ 'LNN', 'NKR' ],
	'SFJ' => [ 'LFT', 'QDM' ],
	'MFX' => [ 'GLP', 'RPN' ],
	'DLX' => [ 'SQQ', 'NHM' ],
	'XQC' => [ 'HQJ', 'NPC' ],
	'GHF' => [ 'VNG', 'TGQ' ],
	'LRX' => [ 'GDT', 'CHG' ],
	'SHV' => [ 'SRM', 'DVJ' ],
	'TQS' => [ 'PRD', 'HGV' ],
	'SQK' => [ 'QNB', 'PSJ' ],
	'CHS' => [ 'MXK', 'GCR' ],
	'VDH' => [ 'FMX', 'XMR' ],
	'DGN' => [ 'LGT', 'PNQ' ],
	'RMM' => [ 'CFK', 'RQD' ],
	'RQK' => [ 'FSN', 'TNB' ],
	'SLH' => [ 'BDS', 'BBP' ],
	'HVR' => [ 'NTS', 'NQG' ],
	'PSJ' => [ 'JFK', 'XXM' ],
	'GBD' => [ 'VMR', 'KJG' ],
	'FRH' => [ 'MNX', 'TVV' ],
	'THH' => [ 'GHF', 'MNF' ],
	'XTP' => [ 'VPC', 'BQQ' ],
	'VMR' => [ 'PCC', 'PPR' ],
	'PPQ' => [ 'GJJ', 'RDL' ],
	'VHK' => [ 'TXT', 'DDN' ],
	'JCG' => [ 'CCD', 'BXL' ],
	'LCQ' => [ 'MPF', 'NDP' ],
	'KCR' => [ 'PFH', 'DJK' ],
	'LHL' => [ 'LGL', 'KCR' ],
	'JMC' => [ 'RBG', 'CGH' ],
	'JPM' => [ 'XMS', 'CVR' ],
	'CLF' => [ 'HDT', 'DHR' ],
	'FSQ' => [ 'XGN', 'RKJ' ],
	'DVJ' => [ 'VHD', 'XNM' ],
	'KCT' => [ 'SKT', 'QLK' ],
	'XFD' => [ 'HXR', 'JVH' ],
	'BVA' => [ 'GPT', 'RSD' ],
	'MGR' => [ 'FHB', 'LKH' ],
	'PXV' => [ 'MJJ', 'VBK' ],
	'FNG' => [ 'TQS', 'HHM' ],
	'GFD' => [ 'XRG', 'JCS' ],
	'SST' => [ 'PHP', 'JGC' ],
	'KJV' => [ 'DMG', 'GGV' ],
	'PQM' => [ 'TTX', 'RMM' ],
	'XRT' => [ 'KBL', 'GHP' ],
	'JLV' => [ 'NKV', 'BLL' ],
	'FKS' => [ 'CBR', 'RLJ' ],
	'HMD' => [ 'JNH', 'GXG' ],
	'FRL' => [ 'KQX', 'DDB' ],
	'TRP' => [ 'LXT', 'HMC' ],
	'TNK' => [ 'FRN', 'FRN' ],
	'KDR' => [ 'PRX', 'LNL' ],
	'XTS' => [ 'NDJ', 'HFB' ],
	'HVM' => [ 'FMG', 'FHN' ],
	'CHH' => [ 'TMD', 'MNM' ],
	'HHM' => [ 'PRD', 'HGV' ],
	'PJC' => [ 'FCC', 'VJD' ],
	'TSH' => [ 'RPR', 'CVJ' ],
	'GGJ' => [ 'NFK', 'NXD' ],
	'DMG' => [ 'RHT', 'SLG' ],
	'QPT' => [ 'QFL', 'PFN' ],
	'DDN' => [ 'RHP', 'NSS' ],
	'XHJ' => [ 'BPQ', 'CSM' ],
	'NNM' => [ 'KHG', 'SRF' ],
	'LFL' => [ 'TMN', 'JCG' ],
	'NKV' => [ 'SNQ', 'MTQ' ],
	'TMH' => [ 'LGT', 'PNQ' ],
	'CCD' => [ 'HLB', 'NVF' ],
	'GSD' => [ 'MRB', 'TFS' ],
	'RHG' => [ 'VXH', 'MXS' ],
	'LFT' => [ 'TKN', 'VDH' ],
	'BJV' => [ 'DST', 'PTK' ],
	'CGD' => [ 'PKG', 'ZZZ' ],
	'VNG' => [ 'BJV', 'HDX' ],
	'HJS' => [ 'GPC', 'BHG' ],
	'FRN' => [ 'VKP', 'KSN' ],
	'MRC' => [ 'JKK', 'CMV' ],
	'BQQ' => [ 'NBF', 'PJC' ],
	'KSN' => [ 'FNJ', 'GVR' ],
	'QNB' => [ 'XXM', 'JFK' ],
	'RSC' => [ 'JCB', 'JCB' ],
	'GCQ' => [ 'XGH', 'FKB' ],
	'SHS' => [ 'JBV', 'DDF' ],
	'LLR' => [ 'XHJ', 'PGB' ],
	'RSA' => [ 'RVH', 'HLV' ],
	'DMX' => [ 'GSH', 'SST' ],
	'HRD' => [ 'HLK', 'DJG' ],
	'LHF' => [ 'NTS', 'NQG' ],
	'JMS' => [ 'FKS', 'HPB' ],
	'SRB' => [ 'SRG', 'GSF' ],
	'LHN' => [ 'HLK', 'DJG' ],
	'DTM' => [ 'RXM', 'VHK' ],
	'PNP' => [ 'SNC', 'LPF' ],
	'MPF' => [ 'BJQ', 'BJQ' ],
	'SCV' => [ 'LHF', 'HVR' ],
	'BTV' => [ 'GLH', 'PNN' ],
	'NJG' => [ 'RXK', 'NXB' ],
	'NGM' => [ 'THG', 'TXQ' ],
	'FXL' => [ 'XRX', 'MBV' ],
	'NHJ' => [ 'DSX', 'NNM' ],
	'RBG' => [ 'DGK', 'LFQ' ],
	'HGV' => [ 'HTS', 'RNP' ],
	'LDF' => [ 'KRB', 'NXC' ],
	'PMR' => [ 'GNH', 'CHQ' ],
	'DVM' => [ 'MNM', 'TMD' ],
	'FBS' => [ 'FRN', 'BXZ' ],
	'BMM' => [ 'XSK', 'DDK' ],
	'GGK' => [ 'MXH', 'JNG' ],
	'NXB' => [ 'LHN', 'HRD' ],
	'PNN' => [ 'JRN', 'BLK' ],
	'PSV' => [ 'LLR', 'KXX' ],
	'KGK' => [ 'TJP', 'QMM' ],
	'CVG' => [ 'VLX', 'CPL' ],
	'QNF' => [ 'XPB', 'PCM' ],
	'HTS' => [ 'PGM', 'RTD' ],
	'FJN' => [ 'DTD', 'SHS' ],
	'JXB' => [ 'CLX', 'KPZ' ],
	'DLT' => [ 'JGH', 'SFD' ],
	'SFV' => [ 'HJM', 'KCT' ],
	'GSF' => [ 'DLX', 'CHL' ],
	'TKN' => [ 'XMR', 'FMX' ],
	'LJB' => [ 'QJT', 'FVJ' ],
	'QFP' => [ 'NXL', 'DGP' ],
	'PKV' => [ 'JKJ', 'MRM' ],
	'RHX' => [ 'RDK', 'XRT' ],
	'KDP' => [ 'FKN', 'HSQ' ],
	'RLJ' => [ 'BGF', 'JRP' ],
	'VQR' => [ 'FDK', 'RLB' ],
	'XNX' => [ 'HGQ', 'HGQ' ],
	'DSX' => [ 'KHG', 'SRF' ],
	'PDS' => [ 'VQK', 'KNJ' ],
	'GKX' => [ 'TKL', 'QPF' ],
	'CHQ' => [ 'XSM', 'HMD' ],
	'KXX' => [ 'XHJ', 'PGB' ],
	'MDB' => [ 'VVV', 'MDV' ],
	'BCG' => [ 'XJX', 'SQK' ],
	'KJM' => [ 'LTK', 'HFM' ],
	'HRR' => [ 'SQK', 'XJX' ],
	'GXD' => [ 'JFM', 'BSV' ],
	'SCR' => [ 'JDN', 'QRS' ],
	'GMK' => [ 'FPF', 'CTM' ],
	'KXM' => [ 'PDJ', 'MFX' ],
	'DKQ' => [ 'GCL', 'QFN' ],
	'DJR' => [ 'FGV', 'PSV' ],
	'GQX' => [ 'DFL', 'LQF' ],
	'PTK' => [ 'TRS', 'TMC' ],
	'BLK' => [ 'GGK', 'GBF' ],
	'RSD' => [ 'XDG', 'SFV' ],
	'SVT' => [ 'PXV', 'XCL' ],
	'XFT' => [ 'BJJ', 'FRH' ],
	'LSR' => [ 'XPV', 'QFP' ],
	'BCP' => [ 'NMB', 'NXM' ],
	'KGP' => [ 'RDT', 'FNB' ],
	'DHF' => [ 'PNN', 'GLH' ],
	'JHH' => [ 'NXD', 'NFK' ],
	'DGP' => [ 'GKX', 'SMX' ],
	'KSK' => [ 'DKP', 'RXT' ],
	'KRM' => [ 'PQM', 'DCK' ],
	'XJX' => [ 'QNB', 'PSJ' ],
	'JKK' => [ 'DJR', 'DHQ' ],
	'CFK' => [ 'DGN', 'TMH' ],
	'PSS' => [ 'HNP', 'STL' ],
	'MFR' => [ 'PMR', 'RJS' ],
	'JNG' => [ 'TQQ', 'HXB' ],
	'MDG' => [ 'VCC', 'HTF' ],
	'VCC' => [ 'DGM', 'MKH' ],
	'TQQ' => [ 'FCQ', 'SCR' ],
	'DMK' => [ 'GXD', 'GFF' ],
	'GHV' => [ 'DTD', 'SHS' ],
	'HLP' => [ 'NNH', 'TQN' ],
	'BGK' => [ 'QHJ', 'BQX' ],
	'VKN' => [ 'DPT', 'FNG' ],
	'STL' => [ 'DPP', 'NMX' ],
	'QFS' => [ 'MGR', 'BGM' ],
	'HSC' => [ 'DHR', 'HDT' ],
	'FPQ' => [ 'NSL', 'RQN' ],
	'QMM' => [ 'CDJ', 'FBP' ],
	'PDL' => [ 'XFR', 'QCG' ],
	'PDJ' => [ 'GLP', 'RPN' ],
	'FSD' => [ 'VFS', 'BGX' ],
	'MPT' => [ 'DKQ', 'RSQ' ],
	'MHQ' => [ 'NTL', 'TKG' ],
	'MPC' => [ 'NQJ', 'NQJ' ],
	'DST' => [ 'TRS', 'TMC' ],
	'KHD' => [ 'CLX', 'CLX' ],
	'BNT' => [ 'MFR', 'CJP' ],
	'VJD' => [ 'GPS', 'CVG' ],
	'DLG' => [ 'JCS', 'XRG' ],
	'MCD' => [ 'CHH', 'DVM' ],
	'VSG' => [ 'XPR', 'TVQ' ],
	'MSX' => [ 'VQR', 'KXQ' ],
	'VMV' => [ 'VQR', 'KXQ' ],
	'QCG' => [ 'NHJ', 'NMH' ],
	'RPN' => [ 'XNC', 'XDM' ],
	'NVG' => [ 'RSC', 'RSC' ],
	'GDT' => [ 'LDC', 'QPT' ],
	'GMX' => [ 'RJX', 'VRM' ],
	'RDL' => [ 'MBH', 'NTF' ],
	'XXM' => [ 'JSC', 'MHQ' ],
	'SRF' => [ 'BGK', 'NQF' ],
	'XNM' => [ 'SGJ', 'XCJ' ],
	'RPT' => [ 'LPM', 'BMP' ],
	'GPT' => [ 'SFV', 'XDG' ],
	'JCB' => [ 'BFL', 'XCM' ],
	'QKQ' => [ 'FRL', 'GGT' ],
	'MTQ' => [ 'LQB', 'XPG' ],
	'CHG' => [ 'QPT', 'LDC' ],
	'FMS' => [ 'FJX', 'GMX' ],
	'MBV' => [ 'LXS', 'TTR' ],
	'JFP' => [ 'XPN', 'TDV' ],
	'JFJ' => [ 'HNP', 'STL' ],
	'GKF' => [ 'RDK', 'XRT' ],
	'LDK' => [ 'QCT', 'TVX' ],
	'CLX' => [ 'RVH', 'HLV' ],
	'TXQ' => [ 'DFR', 'KQF' ],
	'XGH' => [ 'MBX', 'JLC' ],
	'KFB' => [ 'SHV', 'MRV' ],
	'RSV' => [ 'GSX', 'TPK' ],
	'NKR' => [ 'KFB', 'TFN' ],
	'FCQ' => [ 'JDN', 'QRS' ],
	'RQN' => [ 'TLC', 'GFQ' ],
	'FSN' => [ 'FSB', 'KSS' ],
	'QDQ' => [ 'VBQ', 'GSM' ],
	'FFC' => [ 'DKC', 'DMK' ],
	'KBC' => [ 'BHQ', 'TRP' ],
	'PHB' => [ 'VCC', 'HTF' ],
	'GBH' => [ 'FFC', 'CGL' ],
	'TTR' => [ 'KBV', 'LJP' ],
	'MRB' => [ 'DHG', 'QNF' ],
	'SDL' => [ 'PSS', 'JFJ' ],
	'TMC' => [ 'BXK', 'RSV' ],
	'LXT' => [ 'GGB', 'MDT' ],
	'LQB' => [ 'BNT', 'VKM' ],
	'RXT' => [ 'GBH', 'SSD' ],
	'SSN' => [ 'CRH', 'XTP' ],
	'MRV' => [ 'SRM', 'DVJ' ],
	'FJX' => [ 'RJX', 'VRM' ],
	'FQB' => [ 'MNF', 'GHF' ],
	'DKC' => [ 'GFF', 'GXD' ],
	'MGQ' => [ 'LDK', 'RVG' ],
	'DLK' => [ 'FPF', 'CTM' ],
	'FHN' => [ 'HKK', 'BVF' ],
	'BFL' => [ 'LJG', 'XQM' ],
	'PKP' => [ 'VVV', 'MDV' ],
	'QHJ' => [ 'QKQ', 'NSG' ],
	'BCQ' => [ 'HPB', 'FKS' ],
	'LDG' => [ 'VMV', 'MSX' ],
	'BFH' => [ 'RXT', 'DKP' ],
	'XPB' => [ 'JFS', 'PDL' ],
	'HDX' => [ 'PTK', 'DST' ],
	'NQF' => [ 'BQX', 'QHJ' ],
	'DPT' => [ 'TQS', 'HHM' ],
	'DCK' => [ 'TTX', 'RMM' ],
	'NPC' => [ 'KGP', 'QJG' ],
	'BCD' => [ 'NXB', 'RXK' ],
	'HDT' => [ 'HPM', 'FTQ' ],
	'FHD' => [ 'XNK', 'DHM' ],
	'NNS' => [ 'XFD', 'MBT' ],
	'GSX' => [ 'VRG', 'KJV' ],
	'BXG' => [ 'BFH', 'KSK' ],
	'VVB' => [ 'QDQ', 'JXC' ],
	'NVF' => [ 'HNH', 'SNN' ],
	'KRB' => [ 'JBH', 'JNJ' ],
	'FXX' => [ 'GCR', 'MXK' ],
	'JXQ' => [ 'LDM', 'PKV' ],
	'MTT' => [ 'DLG', 'GFD' ],
	'HXR' => [ 'VCH', 'SMV' ],
	'MNM' => [ 'SPQ', 'PNP' ],
	'QJG' => [ 'RDT', 'FNB' ],
	'JLS' => [ 'KRM', 'LBQ' ],
	'CJK' => [ 'TJB', 'VDD' ],
	'TXT' => [ 'RHP', 'NSS' ],
	'FXT' => [ 'JMS', 'BCQ' ],
	'NSS' => [ 'LRX', 'RXF' ],
	'VJQ' => [ 'RSC', 'MXR' ],
	'XXH' => [ 'LNN', 'NKR' ],
	'NSL' => [ 'GFQ', 'TLC' ],
	'XSM' => [ 'GXG', 'JNH' ],
	'HFM' => [ 'TCV', 'GQX' ],
	'JGC' => [ 'NDL', 'JPM' ],
	'HGQ' => [ 'GPT', 'RSD' ],
	'CHL' => [ 'SQQ', 'NHM' ],
	'VBK' => [ 'GKG', 'XTS' ],
	'MBT' => [ 'HXR', 'JVH' ],
	'FNJ' => [ 'SXD', 'QRB' ],
	'JBH' => [ 'HCT', 'SGG' ],
	'JRP' => [ 'FXP', 'VKN' ],
	'VRM' => [ 'MPC', 'GQP' ],
	'BBP' => [ 'JCL', 'LDF' ],
	'GXH' => [ 'RXM', 'VHK' ],
	'MXR' => [ 'JCB', 'TNZ' ],
	'BSD' => [ 'CCP', 'GBD' ],
	'QFN' => [ 'MPL', 'KDP' ],
	'LNN' => [ 'TFN', 'KFB' ],
	'SQQ' => [ 'BLM', 'XQD' ],
	'MJT' => [ 'XNK', 'DHM' ],
	'GSH' => [ 'JGC', 'PHP' ],
	'PQT' => [ 'JXC', 'QDQ' ],
	'RVG' => [ 'QCT', 'TVX' ],
	'DHG' => [ 'PCM', 'XPB' ],
	'LKJ' => [ 'HQP', 'HHG' ],
	'XHB' => [ 'SJL', 'DMX' ],
	'GKG' => [ 'HFB', 'NDJ' ],
	'PGB' => [ 'BPQ', 'CSM' ],
	'VBQ' => [ 'CVS', 'QHF' ],
	'JXC' => [ 'GSM', 'VBQ' ],
	'QCK' => [ 'SDL', 'NMQ' ],
	'PFN' => [ 'NNS', 'GLR' ],
	'RXK' => [ 'LHN', 'HRD' ],
	'BVX' => [ 'GMK', 'DLK' ],
	'LPF' => [ 'MMV', 'LQK' ],
	'SMM' => [ 'SFJ', 'KGR' ],
	'SJL' => [ 'SST', 'GSH' ],
	'HMC' => [ 'MDT', 'GGB' ],
	'VQF' => [ 'CLF', 'HSC' ],
	'NRX' => [ 'RQN', 'NSL' ],
	'CBR' => [ 'JRP', 'BGF' ],
	'JLC' => [ 'KJM', 'XFN' ],
	'TMD' => [ 'SPQ', 'PNP' ],
	'HXB' => [ 'FCQ', 'SCR' ],
	'SBQ' => [ 'SQV', 'NCH' ],
	'LGT' => [ 'MGB', 'XXH' ],
	'HSF' => [ 'TJB', 'VDD' ],
	'JBS' => [ 'MGQ', 'NVQ' ],
	'DKP' => [ 'SSD', 'GBH' ],
	'HSQ' => [ 'SVT', 'LKV' ],
	'GPC' => [ 'HVM', 'TGC' ],
	'TVV' => [ 'DLT', 'CMJ' ],
	'BHG' => [ 'TGC', 'HVM' ],
	'CGR' => [ 'LDN', 'FXT' ],
	'PFH' => [ 'GQJ', 'GQJ' ],
	'FCM' => [ 'JKK', 'CMV' ],
	'RRM' => [ 'KJP', 'BMM' ],
	'FCG' => [ 'MDG', 'PHB' ],
	'MCS' => [ 'HLP', 'DNV' ],
	'BXK' => [ 'GSX', 'TPK' ],
	'VQK' => [ 'HJS', 'GMC' ],
	'LDH' => [ 'XPR', 'TVQ' ],
	'DXN' => [ 'GMK', 'DLK' ],
	'GFQ' => [ 'RQB', 'JFP' ],
	'PKK' => [ 'BBP', 'BDS' ],
	'BBR' => [ 'FXT', 'LDN' ],
	'BJQ' => [ 'KHD', 'KHD' ],
	'RCG' => [ 'MXS', 'VXH' ],
	'HPM' => [ 'KJF', 'CXF' ],
	'QJX' => [ 'CDV', 'RQK' ],
	'NMB' => [ 'RKC', 'GVD' ],
	'JCL' => [ 'KRB', 'NXC' ],
	'GXM' => [ 'BBR', 'CGR' ],
	'NMX' => [ 'XNX', 'SQP' ],
	'NXM' => [ 'RKC', 'GVD' ],
	'QMT' => [ 'MDG', 'PHB' ],
	'DMV' => [ 'LTG', 'SBQ' ],
	'FTQ' => [ 'KJF', 'CXF' ],
	'TCV' => [ 'DFL', 'LQF' ],
	'MFJ' => [ 'TXQ', 'THG' ],
	'VKP' => [ 'FNJ', 'GVR' ],
	'XQD' => [ 'CSG', 'KKQ' ],
	'SRM' => [ 'VHD', 'XNM' ],
	'SLG' => [ 'LRJ', 'JFL' ],
	'JCS' => [ 'CQP', 'CXD' ],
	'LJP' => [ 'MCQ', 'MCS' ],
	'NBF' => [ 'FCC', 'VJD' ],
	'DFL' => [ 'KDR', 'GFC' ],
	'NFM' => [ 'XBN', 'BXG' ],
	'CMR' => [ 'PKG', 'PKG' ],
	'JVN' => [ 'XHB', 'MCC' ],
	'RKC' => [ 'FSQ', 'MFD' ],
	'JKJ' => [ 'BSQ', 'LJB' ],
	'BGX' => [ 'MMD', 'FMS' ],
	'THG' => [ 'KQF', 'DFR' ],
	'RKJ' => [ 'CVN', 'FFK' ],
	'LQK' => [ 'CHS', 'FXX' ],
	'CPL' => [ 'VXL', 'KCF' ],
	'JSC' => [ 'TKG', 'NTL' ],
	'DNV' => [ 'TQN', 'NNH' ],
	'LFF' => [ 'HQJ', 'NPC' ],
	'TVQ' => [ 'SSF', 'GXM' ],
	'NQR' => [ 'LCQ', 'GRV' ],
	'TMN' => [ 'BXL', 'CCD' ],
	'XDM' => [ 'KXS', 'JLS' ],
	'CJP' => [ 'RJS', 'PMR' ],
	'HKV' => [ 'NMB', 'NXM' ],
	'SPQ' => [ 'SNC', 'LPF' ],
	'HQJ' => [ 'KGP', 'QJG' ],
	'GXG' => [ 'JMC', 'GVV' ],
	'KSS' => [ 'CND', 'PPQ' ],
	'LJG' => [ 'DTM', 'GXH' ],
	'BHQ' => [ 'HMC', 'LXT' ],
	'FGV' => [ 'KXX', 'LLR' ],
	'KCF' => [ 'LKJ', 'NTJ' ],
	'PRM' => [ 'MFX', 'PDJ' ],
	'QKD' => [ 'FXL', 'SQL' ],
	'DDB' => [ 'CSB', 'MCD' ],
	'VHH' => [ 'CMR', 'CGD' ],
	'LLM' => [ 'BVX', 'DXN' ],
	'PTN' => [ 'RSQ', 'DKQ' ],
	'GSM' => [ 'CVS', 'QHF' ],
	'CVN' => [ 'VHS', 'LDG' ],
	'RHT' => [ 'LRJ', 'JFL' ],
	'JFK' => [ 'JSC', 'MHQ' ],
	'NTS' => [ 'QFS', 'GQR' ],
	'TQN' => [ 'DHF', 'BTV' ],
	'KHG' => [ 'BGK', 'NQF' ],
	'ZZZ' => [ 'FXC', 'VQF' ],
	'VXL' => [ 'NTJ', 'LKJ' ],
	'VFS' => [ 'MMD', 'FMS' ],
	'LBQ' => [ 'PQM', 'DCK' ],
	'KQX' => [ 'CSB', 'MCD' ],
	'FDK' => [ 'XFT', 'PKM' ],
	'NQG' => [ 'GQR', 'QFS' ],
	'KXS' => [ 'LBQ', 'KRM' ],
	'JDN' => [ 'HDL', 'CCB' ],
	'TKL' => [ 'HSF', 'CJK' ],
	'XRG' => [ 'CQP', 'CXD' ],
	'BMP' => [ 'RCG', 'RHG' ],
	'KQF' => [ 'KGK', 'LGN' ],
	'HLK' => [ 'MTT', 'PFT' ],
	'NFK' => [ 'MRS', 'CNV' ],
	'HNH' => [ 'MFJ', 'NGM' ],
	'FKN' => [ 'SVT', 'LKV' ],
	'VPC' => [ 'PJC', 'NBF' ],
	'DDK' => [ 'SVS', 'QKD' ],
	'DCJ' => [ 'RPR', 'CVJ' ],
	'NQJ' => [ 'CMR', 'CMR' ],
	'LGL' => [ 'PFH', 'PFH' ],
	'RTD' => [ 'CDQ', 'LJV' ],
	'FVJ' => [ 'FJN', 'GHV' ],
	'BDS' => [ 'LDF', 'JCL' ],
	'NSG' => [ 'GGT', 'FRL' ],
	'RXM' => [ 'DDN', 'TXT' ],
	'JNJ' => [ 'SGG', 'HCT' ],
	'SRG' => [ 'DLX', 'CHL' ],
	'TGC' => [ 'FMG', 'FHN' ],
	'FMG' => [ 'BVF', 'HKK' ],
	'NTJ' => [ 'HHG', 'HQP' ],
	'KNJ' => [ 'HJS', 'GMC' ],
	'QJB' => [ 'CCP', 'GBD' ],
	'NXL' => [ 'SMX', 'GKX' ],
	'VHS' => [ 'MSX', 'VMV' ],
	'CRH' => [ 'BQQ', 'VPC' ],
	'GFF' => [ 'JFM', 'BSV' ],
	'GLR' => [ 'XFD', 'MBT' ],
	'XPR' => [ 'GXM', 'SSF' ],
	'LLD' => [ 'BLL', 'NKV' ],
	'KXQ' => [ 'FDK', 'RLB' ],
	'MXH' => [ 'TQQ', 'HXB' ],
	'RQD' => [ 'DGN', 'TMH' ],
	'FNB' => [ 'NVG', 'VJQ' ],
	'MGH' => [ 'KHD', 'JXB' ],
	'JGL' => [ 'BMM', 'KJP' ],
	'KJF' => [ 'SCV', 'PHF' ],
	'SXD' => [ 'BCG', 'HRR' ],
	'TPK' => [ 'KJV', 'VRG' ],
	'TJP' => [ 'FBP', 'CDJ' ],
	'MKH' => [ 'KXM', 'PRM' ],
	'HJM' => [ 'SKT', 'QLK' ],
	'GHP' => [ 'RFL', 'KBC' ],
	'LGN' => [ 'TJP', 'QMM' ],
	'LJV' => [ 'JLV', 'LLD' ],
	'NXD' => [ 'CNV', 'MRS' ],
	'LKH' => [ 'LLM', 'BNK' ],
	'CTM' => [ 'MPT', 'PTN' ],
	'SNC' => [ 'LQK', 'MMV' ],
	'PNQ' => [ 'XXH', 'MGB' ],
	'FMX' => [ 'BSD', 'QJB' ],
	'QQL' => [ 'HHH', 'SSN' ],
	'QLK' => [ 'FCM', 'MRC' ],
	'CMJ' => [ 'JGH', 'SFD' ],
	'FHB' => [ 'BNK', 'LLM' ],
	'TKG' => [ 'FQB', 'THH' ],
	'XPV' => [ 'DGP', 'NXL' ],
	'RHP' => [ 'LRX', 'RXF' ],
	'BRQ' => [ 'LBN', 'DMV' ],
	'NDL' => [ 'XMS', 'CVR' ],
	'LDC' => [ 'PFN', 'QFL' ],
	'DPP' => [ 'XNX', 'XNX' ],
	'NMQ' => [ 'PSS', 'JFJ' ],
	'SGG' => [ 'PQT', 'VVB' ],
	'FSR' => [ 'RPT', 'PVF' ],
	'AAA' => [ 'VQF', 'FXC' ],
	'JFL' => [ 'BJB', 'NFM' ],
	'XFR' => [ 'NHJ', 'NMH' ],
	'HHS' => [ 'SFJ', 'KGR' ],
	'MLZ' => [ 'RSD', 'GPT' ],
	'MNF' => [ 'VNG', 'TGQ' ],
	'FXP' => [ 'DPT', 'FNG' ],
	'MRS' => [ 'SDP', 'NQR' ],
	'MDT' => [ 'JGL', 'RRM' ],
	'MJJ' => [ 'GKG', 'XTS' ],
	'PFT' => [ 'GFD', 'DLG' ],
	'TVX' => [ 'BCD', 'NJG' ],
	'NPA' => [ 'VKP', 'KSN' ],
	'TDV' => [ 'LDH', 'VSG' ],
	'GQJ' => [ 'PDM', 'PDM' ],
	'NTF' => [ 'GKF', 'RHX' ],
	'GGT' => [ 'KQX', 'DDB' ],
	'LFN' => [ 'TFS', 'MRB' ],
	'CSM' => [ 'MJT', 'FHD' ],
	'NVQ' => [ 'RVG', 'LDK' ],
	'PKM' => [ 'FRH', 'BJJ' ],
	'PDM' => [ 'BRQ', 'XPL' ],
	'JGH' => [ 'BHC', 'QQL' ],
	'SSF' => [ 'CGR', 'BBR' ],
	'GVV' => [ 'CGH', 'RBG' ],
	'FSB' => [ 'PPQ', 'CND' ],
	'LKV' => [ 'XCL', 'PXV' ],
	'MXK' => [ 'SLH', 'PKK' ],
	'SQL' => [ 'XRX', 'MBV' ],
	'LRJ' => [ 'BJB', 'NFM' ],
	'VXH' => [ 'LFF', 'XQC' ],
	'HTF' => [ 'MKH', 'DGM' ],
	'CTB' => [ 'LGL', 'KCR' ],
	'HFB' => [ 'RTL', 'GCQ' ],
	'NTL' => [ 'FQB', 'THH' ],
	'SFD' => [ 'QQL', 'BHC' ],
	'HNP' => [ 'DPP', 'DPP' ],
	'TTX' => [ 'RQD', 'CFK' ],
	'MCQ' => [ 'HLP', 'DNV' ],
	'CCP' => [ 'VMR', 'KJG' ],
	'TFN' => [ 'MRV', 'SHV' ],
	'JKB' => [ 'PDM', 'RFZ' ],
	'TGQ' => [ 'BJV', 'HDX' ],
	'PHP' => [ 'JPM', 'NDL' ],
	'RJX' => [ 'MPC', 'GQP' ],
	'CVJ' => [ 'LFL', 'KLG' ],
	'KJP' => [ 'DDK', 'XSK' ],
	'QPF' => [ 'HSF', 'CJK' ],
	'SNQ' => [ 'XPG', 'LQB' ],
	'BGF' => [ 'VKN', 'FXP' ],
	'KLG' => [ 'TMN', 'JCG' ],
	'CGL' => [ 'DMK', 'DKC' ],
	'XCM' => [ 'XQM', 'LJG' ],
	'RPR' => [ 'LFL', 'KLG' ],
	'LFQ' => [ 'KBF', 'SRB' ],
	'RJS' => [ 'CHQ', 'GNH' ],
	'HDL' => [ 'KPR', 'QCK' ],
	'FXJ' => [ 'MCC', 'XHB' ],
	'XPG' => [ 'VKM', 'BNT' ],
	'DHQ' => [ 'FGV', 'PSV' ],
	'SQV' => [ 'QMT', 'FCG' ],
	'DHR' => [ 'FTQ', 'HPM' ],
	'FCC' => [ 'GPS', 'CVG' ],
	'NCH' => [ 'FCG', 'QMT' ],
	'QRS' => [ 'HDL', 'CCB' ],
	'XQM' => [ 'GXH', 'DTM' ],
	'SGJ' => [ 'TSH', 'DCJ' ],
	'KBL' => [ 'RFL', 'KBC' ],
	'NXC' => [ 'JBH', 'JNJ' ],
	'BSQ' => [ 'QJT', 'FVJ' ],
	'LTG' => [ 'NCH', 'SQV' ],
	'SMV' => [ 'JBS', 'MDQ' ],
	'GJJ' => [ 'MBH', 'NTF' ],
	'GRV' => [ 'MPF', 'NDP' ],
	'HPB' => [ 'RLJ', 'CBR' ],
	'TRS' => [ 'BXK', 'RSV' ],
	'GCR' => [ 'SLH', 'PKK' ],
	'HHH' => [ 'CRH', 'XTP' ],
	'GNH' => [ 'XSM', 'HMD' ],
	'RSQ' => [ 'QFN', 'GCL' ],
	'HKK' => [ 'QJX', 'FKK' ],
	'JBV' => [ 'TNK', 'TNK' ],
	'TFS' => [ 'DHG', 'QNF' ],
	'RTL' => [ 'FKB', 'XGH' ],
	'HHG' => [ 'XPT', 'JXQ' ],
	'PPR' => [ 'LHL', 'CTB' ],
	'SQP' => [ 'HGQ', 'MLZ' ],
	'XBN' => [ 'BFH', 'KSK' ],
	'CVR' => [ 'MDB', 'PKP' ],
	'RFL' => [ 'BHQ', 'TRP' ],
	'QHX' => [ 'FSR', 'NTN' ],
	'VCH' => [ 'MDQ', 'JBS' ],
	'GCL' => [ 'MPL', 'KDP' ],
	'KKQ' => [ 'GGJ', 'JHH' ],
	'GFC' => [ 'PRX', 'LNL' ],
	'PRD' => [ 'HTS', 'RNP' ],
	'GQP' => [ 'NQJ', 'VHH' ],
	'LJC' => [ 'VQK', 'KNJ' ],
	'QCT' => [ 'BCD', 'NJG' ],
	'KBF' => [ 'SRG', 'GSF' ],
	'NNH' => [ 'BTV', 'DHF' ],
	'SSD' => [ 'CGL', 'FFC' ],
	'VDD' => [ 'HKV', 'BCP' ],
	'VHD' => [ 'XCJ', 'SGJ' ],
	'RFZ' => [ 'XPL', 'BRQ' ],
	'KGR' => [ 'LFT', 'QDM' ],
	'MDQ' => [ 'NVQ', 'MGQ' ],
	'MXS' => [ 'LFF', 'XQC' ],
	'PCC' => [ 'LHL', 'CTB' ],
	'TLC' => [ 'RQB', 'JFP' ],
	'CVS' => [ 'PJP', 'QHX' ],
	'BNK' => [ 'DXN', 'BVX' ],
	'CSB' => [ 'CHH', 'DVM' ],
	'XPN' => [ 'VSG', 'LDH' ],
	'XSK' => [ 'SVS', 'QKD' ],
	'LBN' => [ 'LTG', 'SBQ' ],
	'FKK' => [ 'RQK', 'CDV' ],
	'MCC' => [ 'SJL', 'DMX' ],
	'NMH' => [ 'DSX', 'NNM' ],
	'MMD' => [ 'GMX', 'FJX' ],
	'LXS' => [ 'LJP', 'KBV' ],
	'XMR' => [ 'QJB', 'BSD' ],
	'DFR' => [ 'KGK', 'LGN' ],
	'DJG' => [ 'PFT', 'MTT' ],
	'CGH' => [ 'DGK', 'LFQ' ],
	'MRM' => [ 'BSQ', 'LJB' ],
	'XCL' => [ 'MJJ', 'VBK' ],
	'GBF' => [ 'JNG', 'MXH' ],
	'XGN' => [ 'FFK', 'CVN' ],
];