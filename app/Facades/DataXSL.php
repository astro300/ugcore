<?php

namespace UGCore\Facades;


class DataXSL {

public function menuOptions(){
	return 
"<?xml version='1.0' encoding='utf-8'?>
<xsl:stylesheet version='1.0' xmlns:xsl='http://www.w3.org/1999/XSL/Transform'>
    <xsl:output method='html' indent='yes' encoding='utf-8'/>
    <xsl:template match='/menus'>
        <xsl:call-template name='MenuListing' />
    </xsl:template>
    <xsl:template name='MenuListing'>
			<ul class=\"sidebar-menu\">
				<li class=\"header text-center\">OPCIONES DISPONIBLES</li>
				<xsl:apply-templates select='menu' />
			</ul>
    </xsl:template>
    <xsl:template match='menu'>
        <li class='treeview'>
            <xsl:element name='a'>
                 <xsl:attribute name='href'>[path]/master/<xsl:value-of select='@url'/></xsl:attribute>
                 <xsl:attribute name='style'>white-space: normal</xsl:attribute>
                    <xsl:element name='i'>
                        <xsl:attribute name='style'>padding-right: 5px;</xsl:attribute>
                        <xsl:attribute name='class'><xsl:value-of select='@icono'/></xsl:attribute>
                    </xsl:element>
                   <span>   <xsl:value-of select='@name'/></span>
           <xsl:if test='count(menuItem) > 0'>
		   <span class='pull-right-container'>
              <i class='fa fa-angle-left pull-right'></i>
            </span>	
			 </xsl:if>	   
			</xsl:element>
            <xsl:if test='count(menuItem) > 0'>  		
                <xsl:call-template name='MenuListingItem' />
            </xsl:if>
        </li>
    </xsl:template>
	
	
    <xsl:template name='MenuListingItem'>
        <ul class=\"treeview-menu\">
            <xsl:apply-templates select='menuItem' />
        </ul>
    </xsl:template>
    <xsl:template match='menuItem'>
        <li>
            <xsl:element name='a'>
               <xsl:attribute name='href'>[path]/master/<xsl:value-of select='@url'/></xsl:attribute>
			                     <xsl:attribute name='style'>white-space: normal</xsl:attribute>
              <xsl:value-of select='@name'/>
                 <xsl:if test='count(menuItem) > 0'>
		   <span class='pull-right-container'>
              <i class='fa fa-angle-left pull-right'></i>
            </span>	
			 </xsl:if>	   
            </xsl:element>
            
            <xsl:if test='count(menuItem) > 0'>      	
                <xsl:call-template name='MenuListingItem' />
            </xsl:if>
        </li>
    </xsl:template>
</xsl:stylesheet>";
}


public function menu($disabled=false) {
$disabled= $disabled==true?'<xsl:attribute name="disabled">disabled</xsl:attribute>':'';
return '<?xml version="1.0" encoding="utf-8"?>
	<xsl:stylesheet version="1.0"
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

	<xsl:output method="xml" indent="yes" encoding="utf-8" />

	<xsl:template match="/menus">
		<xsl:call-template name="MenuListing" />
	</xsl:template>

	<xsl:template name="MenuListing">
		<ul class="treeview">
			<xsl:apply-templates select="menu" />
		</ul>
	</xsl:template>


	<xsl:template match="menu">
		<xsl:element name="li">
			
			<xsl:attribute name="id"><xsl:text>li_</xsl:text><xsl:value-of
				select="@code" /></xsl:attribute>
		 <div class="checkbox icheck">
<label >
		<xsl:element name="input">
				
					<xsl:attribute name="type">checkbox</xsl:attribute>
					<xsl:attribute name="value"><xsl:value-of
						select="@code" /></xsl:attribute>
					<xsl:attribute name="name">option[]</xsl:attribute>
					'.$disabled.'
				
					<xsl:attribute name="id"><xsl:text>chk_</xsl:text><xsl:value-of
						select="@code" /></xsl:attribute>
					<xsl:if test="@checked=\'si\'">
						<xsl:attribute name="checked">checked</xsl:attribute>
					</xsl:if>
		</xsl:element>
		
		      
		       
				<span class="text-bold"><xsl:value-of select="@name" /></span>
		
</label> 

</div>

			<xsl:if test="count(menuItem) > 0">
				<xsl:call-template name="MenuListingItem" />
			</xsl:if>
		</xsl:element>
	</xsl:template>

	<xsl:template name="MenuListingItem">
		<ul> 
			<xsl:apply-templates select="menuItem" />
		</ul>
	</xsl:template>

	<xsl:template match="menuItem">
		<xsl:element name="li">
			<xsl:attribute name="id"><xsl:text>li_</xsl:text><xsl:value-of
				select="@code" /></xsl:attribute>
			
		 <div class="checkbox icheck">
<label >
			<xsl:element name="input">
			'.$disabled.'
				<xsl:attribute name="class">styled</xsl:attribute>
				<xsl:attribute name="type">checkbox</xsl:attribute>
				<xsl:attribute name="value"><xsl:value-of select="@code" /></xsl:attribute>
				<xsl:attribute name="name">option[]</xsl:attribute>
				<!-- <xsl:attribute name="onchange"><xsl:text>javascript:checkChildren($("#li_</xsl:text><xsl:value-of 
					select="@code"/><xsl:text>"),this)</xsl:text></xsl:attribute> -->
				<xsl:attribute name="id"><xsl:text>chk_</xsl:text><xsl:value-of
					select="@code" /></xsl:attribute>
				<xsl:if test="@checked=\'si\'">
					<xsl:attribute name="checked">checked</xsl:attribute>
				</xsl:if>
			</xsl:element>
			
				
				<span class="text-bolder"><xsl:value-of select="@name" /></span>
				
			</label>
			</div>
			<xsl:if test="count(menuItem) > 0">
				<xsl:call-template name="MenuListingItem" />
			</xsl:if>
		</xsl:element>
	</xsl:template>
</xsl:stylesheet>';

}





/*public static function menu($disabled=false) {
$disabled= $disabled==true?'<xsl:attribute name="disabled">disabled</xsl:attribute>':'';
return '<?xml version="1.0" encoding="utf-8"?>
	<xsl:stylesheet version="1.0"
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

	<xsl:output method="xml" indent="yes" encoding="utf-8" />

	<xsl:template match="/menus">
		<xsl:call-template name="MenuListing" />
	</xsl:template>

	<xsl:template name="MenuListing">
		<ul class="treeview">
			<xsl:apply-templates select="menu" />
		</ul>
	</xsl:template>


	<xsl:template match="menu">
		<xsl:element name="li">
			
			<xsl:attribute name="id"><xsl:text>li_</xsl:text><xsl:value-of
				select="@code" /></xsl:attribute>
		

		<xsl:element name="input">
					<xsl:attribute name="class">styled</xsl:attribute>
					<xsl:attribute name="type">checkbox</xsl:attribute>
					<xsl:attribute name="value"><xsl:value-of
						select="@code" /></xsl:attribute>
					<xsl:attribute name="name">option[]</xsl:attribute>
					'.$disabled.'
				
					<xsl:attribute name="id"><xsl:text>chk_</xsl:text><xsl:value-of
						select="@code" /></xsl:attribute>
					<xsl:if test="@checked=\'si\'">
						<xsl:attribute name="checked">checked</xsl:attribute>
					</xsl:if>
		</xsl:element>
		<xsl:element name="label" >
			<xsl:attribute name="class">custom-unchecked</xsl:attribute>
				<xsl:attribute name="for"><xsl:text>chk_</xsl:text><xsl:value-of
						select="@code" /></xsl:attribute>
				
				<xsl:value-of select="@name" />
		</xsl:element>
			<xsl:if test="count(menuItem) > 0">
				<xsl:call-template name="MenuListingItem" />
			</xsl:if>
		</xsl:element>
	</xsl:template>

	<xsl:template name="MenuListingItem">
		<ul>
			<xsl:apply-templates select="menuItem" />
		</ul>
	</xsl:template>

	<xsl:template match="menuItem">
		<xsl:element name="li">
			<xsl:attribute name="id"><xsl:text>li_</xsl:text><xsl:value-of
				select="@code" /></xsl:attribute>
			
			<xsl:element name="input">
			'.$disabled.'
				<xsl:attribute name="class">styled</xsl:attribute>
				<xsl:attribute name="type">checkbox</xsl:attribute>
				<xsl:attribute name="value"><xsl:value-of select="@code" /></xsl:attribute>
				<xsl:attribute name="name">option[]</xsl:attribute>
				<!-- <xsl:attribute name="onchange"><xsl:text>javascript:checkChildren($("#li_</xsl:text><xsl:value-of 
					select="@code"/><xsl:text>"),this)</xsl:text></xsl:attribute> -->
				<xsl:attribute name="id"><xsl:text>chk_</xsl:text><xsl:value-of
					select="@code" /></xsl:attribute>
				<xsl:if test="@checked=\'si\'">
					<xsl:attribute name="checked">checked</xsl:attribute>
				</xsl:if>
			</xsl:element>
			
				<xsl:element name="label">
					<xsl:attribute name="class">custom-unchecked</xsl:attribute>
					<xsl:attribute name="for"><xsl:text>chk_</xsl:text><xsl:value-of
						select="@code" /></xsl:attribute>
				<xsl:value-of select="@name" />
				</xsl:element>
			<xsl:if test="count(menuItem) > 0">
				<xsl:call-template name="MenuListingItem" />
			</xsl:if>
		</xsl:element>
	</xsl:template>
</xsl:stylesheet>';

}
*/

}