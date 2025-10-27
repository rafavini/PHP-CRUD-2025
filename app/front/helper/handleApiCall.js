
export async function HandleApiCall({
  url,
  method = "GET",
  headers = {},
  body = null,
  params = {},
  showAlert = true,
  showLoading = true,
}) {
  try {
    const queryString = new URLSearchParams(params).toString();
    const fullUrl = queryString ? `${url}?${queryString}` : url;
    const isFormData = body instanceof FormData;

    const options = {
      method: method.toUpperCase(),
      headers: isFormData
        ? headers
        : { "Content-Type": "application/json", ...headers },
    };

    if (body && method !== "GET") {
      options.body = isFormData ? body : JSON.stringify(body);
    }

    if (showLoading) {
      Swal.fire({
        title: "Carregando...",
        allowOutsideClick: false,
        didOpen: () => Swal.showLoading(),
      });
    }

    const response = await fetch(fullUrl, options);
    const data = await response.json();

    if (showLoading) Swal.close();
    if (!response.ok) throw new Error(data || `Erro ${response.status}`);

    if (showAlert && method !== "GET") {
      Swal.fire({
        icon: "success",
        title: "Sucesso!",
        text: data.message || "Operação realizada com sucesso!",
        toast: true,
        timer: 2500,
        showConfirmButton: false,
        position: "top-end",
      });
    }

    return data;
  } catch (error) {
    console.log(error)
    // console.error("Erro na requisição:", error);
    if (showLoading) Swal.close();

    if (showAlert && method !== "GET") {
      Swal.fire({
        icon: "error",
        title: "Erro!",
        text: error || "Ocorreu um erro inesperado.",
        toast: true,
        timer: 3000,
        showConfirmButton: false,
        position: "top-end",
      });
    }

    return { error: error.message };
  }
}
