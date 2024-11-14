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
      if(paginaActual <= numElementoPorPagina/2){
        desde = 1;
        hasta = numElementosPorPagina;
      }
    }
  }

  
}
