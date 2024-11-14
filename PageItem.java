

public class PageItem{

  private int numero;
  private boolean actual;

  public PageItem(int numero, boolean actual){
    super();
    this.numero = numero;
    this.actual= actual;
  }

  public int getNumero(){
    this.numero= numero;
  }

  public boolean isActual(){
    return actual;
  }
  
  public void setActual(boolean actual){
    this.actual = actual;
  }
}
