import java.time.LocalDateTime;

public class Fuvar {
	private int taxi_id;
	private LocalDateTime indulas;
	private int idotartam;
	private double tavolsag;
	private double viteldij;
	private double borravalo;
	private String fizetes_modja;

	public Fuvar(int taxi_id, LocalDateTime indulas, int idotartam, double tavolsag, double viteldij, double borravalo,
			String fizetes_modja) {
		super();
		this.taxi_id = taxi_id;
		this.indulas = indulas;
		this.idotartam = idotartam;
		this.tavolsag = tavolsag;
		this.viteldij = viteldij;
		this.borravalo = borravalo;
		this.fizetes_modja = fizetes_modja;
	}

	public int getTaxi_id() {
		return taxi_id;
	}

	public void setTaxi_id(int taxi_id) {
		this.taxi_id = taxi_id;
	}

	public LocalDateTime getIndulas() {
		return indulas;
	}

	public void setIndulas(LocalDateTime indulas) {
		this.indulas = indulas;
	}

	public int getIdotartam() {
		return idotartam;
	}

	public void setIdotartam(int idotartam) {
		this.idotartam = idotartam;
	}

	public double getTavolsag() {
		return tavolsag;
	}

	public void setTavolsag(double tavolsag) {
		this.tavolsag = tavolsag;
	}

	public double getViteldij() {
		return viteldij;
	}

	public void setViteldij(double viteldij) {
		this.viteldij = viteldij;
	}

	public double getBorravalo() {
		return borravalo;
	}

	public void setBorravalo(double borravalo) {
		this.borravalo = borravalo;
	}

	public String getFizetes_modja() {
		return fizetes_modja;
	}

	public void setFizetes_modja(String fizetes_modja) {
		this.fizetes_modja = fizetes_modja;
	}

	@Override
	public String toString() {
		return "Fuvar [taxi_id=" + taxi_id + ", indulas=" + indulas + ", idotartam=" + idotartam + ", tavolsag="
				+ tavolsag + ", viteldij=" + viteldij + ", borravalo=" + borravalo + ", fizetes_modja=" + fizetes_modja
				+ "]";
	}

}
