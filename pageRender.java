package com.gestion.empleados.util.paginacion;

import java.util.ArrayList;                       

public class PageRender<T>{

  private String url;
  private Page<T> page;
  private int totalPaginas;
  private int paginaActual;
  private List<PageItem> paginas;

  public PageRender(string url, Page<T> page){
    this.url = url;                      
    this.page = page;                      
    this.paginas = new ArrayList<PageItem>();

    numElementosPorPagina = 5;
    totalPaginas = page.getTotalPages();
    paginaActual = page.getNumber();

    int desde , hasta;
    if(totalPaginas <= numElementosPorPagina){
      desde = 1;
      hata = totalPaginas;
    }else{                                              
      if(paginaActual <= numElementosPorPagina/2){
        desde = 1;
        hasta = numElementosPorPagina;
      }
      else if(paginaActual >= totalPaginas - numElementosPorPagina + 1){
        desde = totalPaginas - numElementosPorPagina + 1;
        hasta = numElementosPorPagina;
      }else{
        desde = paginaActual - numElementosPorPagina/2;
        hasta = numElementosPorPagina;
      }
    }
    for(int i = 0; i < hasta; i++){
      paginas.add(new PageItem(desde + i, paginaActual == desde + i));
    }
  }
  public String getUrl(){
    return url;
  }
  
  public void setUrl(String url){
    this.url = url;
  }
  
  public int getTotalPaginas(){
    return totalPaginas;
  }

  public void setTotalPaginas(int totalPaginas){
    this.totalPaginas = totalPaginas;
  }

  public int getPaginaActual(int paginaActual){
    this.paginaActual = paginaActual;
  }

  public void setPaginaActual(int paginaActual){
    this.paginaActual = paginaActual;
  }

  public List<PageItem> getPaginas(){
    return paginas;
  }

  public void setPaginas(List<PageItem> paginas) {
    this.paginas = paginas;
  }

  public boolean isHasNext(){
    return page.isLast();
  }

  public boolean isHasNext(){
    return page.hasNext();
  }

  public boolean isHasPrevius(){
    return page.hasPrevius();
  }
  
}
